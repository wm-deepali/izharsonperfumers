<?php

namespace App\Helpers;

use App\Models\Pincode;
use App\Models\ShippingCost;
use App\Models\SiteGstSetting;
use App\Models\FreeShiping;

class ShippingHelper
{
    public static function calculate($pincode, $billingPincode, $cartQuantity, $cartAmount)
    {
        try {

            $TotalShipCost = 0;

            $billing_pincode = Pincode::where('pincode', $billingPincode)->first();
            $shipping_pincode = Pincode::where('pincode', $pincode)->count();

            if (!$billing_pincode || !$shipping_pincode) {
                return [
                    'success' => false,
                    'message' => 'Pincode not serviceable'
                ];
            }

            $state = Pincode::where('pincode', $pincode)->firstOrFail();
            $gst = SiteGstSetting::firstOrFail();

            $shippingCosts = ShippingCost::latest()
                ->limit(3)
                ->where('status', 'active')
                ->get();

            foreach ($shippingCosts as $shippingCost) {

                if ($gst->state_id == $state->state_id) {
                    $charge = $shippingCost->in_state_charge;
                } else {
                    $charge = $shippingCost->out_state_charge;
                }

                $TotalShipCost = min(
                    $charge * $cartQuantity,
                    $shippingCost->max_charges
                );

                // GST Calculation
                if ($gst->gst_status == "yes") {

                    if ($gst->state_id == $billing_pincode->state_id) {

                        $sgst = ($cartAmount + $TotalShipCost) * ($gst->sgst_percent / 100);
                        $cgst = ($cartAmount + $TotalShipCost) * ($gst->cgst_percent / 100);
                        $gstAmount = $sgst + $cgst;
                        $gstType = 'CGST + SGST';

                    } else {

                        $gstAmount = ($cartAmount + $TotalShipCost) * ($gst->igst_percent / 100);
                        $gstType = 'IGST';
                    }

                } else {

                    $gstAmount = ($cartAmount + $TotalShipCost) * ($gst->vat / 100);
                    $gstType = 'VAT';
                }

                $totalCart = round($cartAmount + $TotalShipCost + $gstAmount, 2);

                $shippingCost->TotalShipCost = $TotalShipCost;
                $shippingCost->totalCartAmount = $totalCart;
                $shippingCost->total_gst_amount = round($gstAmount, 2);
                $shippingCost->gst_type = $gstType;
                $shippingCost->shipping_type = "paid";
            }

            /*
            |--------------------------------
            | FREE SHIPPING CHECK
            |--------------------------------
            */

            if ($gst->state_id == $billing_pincode->state_id) {
                $free = FreeShiping::where('status', 'active')
                    ->where('min_order_value_intrastate', '<=', $cartAmount)
                    ->first();
            } else {
                $free = FreeShiping::where('status', 'active')
                    ->where('min_order_value_interstate', '<=', $cartAmount)
                    ->first();
            }

            if ($free) {

                if ($gst->state_id == $billing_pincode->state_id) {
                    $gstAmount = $cartAmount * ($gst->sgst_percent + $gst->cgst_percent) / 100;
                    $gstType = 'CGST + SGST';
                } else {
                    $gstAmount = $cartAmount * $gst->igst_percent / 100;
                    $gstType = 'IGST';
                }

                $totalCart = round($cartAmount + $gstAmount, 2);

                return [
                    'success' => true,
                    'shippingCost' => [
                        [
                            'TotalShipCost' => 0,
                            'totalCartAmount' => $totalCart,
                            'total_gst_amount' => round($gstAmount, 2),
                            'gst_type' => $gstType,
                            'shipping_type' => 'free',
                            'delivery_days_range' => $free->day_range_inter_state
                        ]
                    ]
                ];
            }

            return [
                'success' => true,
                'shippingCost' => $shippingCosts
            ];

        } catch (\Exception $e) {

            return [
                'success' => false,
                'message' => $e->getMessage()
            ];
        }
    }
}