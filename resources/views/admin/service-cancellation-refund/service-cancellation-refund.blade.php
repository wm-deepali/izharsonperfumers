@include('admin.header')
<div class="app-content content container-fluid">
    <div class="content-wrapper">
        <div class="content-header row">
            <div class="content-header-left col-md-6 col-xs-12 mb-2">
                <h3 class="content-header-title mb-0">Service Cancellation</h3>
                <div class="row breadcrumbs-top">
                    <div class="breadcrumb-wrapper col-xs-12">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="https://eagledemo.xyz/opalmarketings/admin/dashboard">Dashboard</a></li>
                            
                            <li class="breadcrumb-item active">Service Cancellation</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-12 col-lg-12">
            <div class="card">
                <section>
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="card-body collapse in">
                                <div class="card-block card-dashboard">
                                    <div class="table-responsive">
                                        <table class="table table-striped table-bordered" id="example">
                                            <thead>
                                                <tr>
                                                    <th>Date &amp; Time</th>
                                                    <th>Booking ID</th>
                                                    <th>Customer Name</th>
                                                    <th>Mobile Number</th>
                                                    <th>Email ID</th>
                                                    <th>Service Name</th>
                                                    <th>Parent Category</th>
                                                    <th>Payment Status</th>
                                                    <th>Customer Request</th>
                                                    <th>Service Status</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                 <tr>
                                                    <td>2022-12-20 10:42:33</td>
                                                    <td>#SERV012356467</td>
                                                    <td>test</td>
                                                    <td>112445555</td>
                                                    <td>test@gmail.com</td>
                                                    <td>Ac Service</td>
                                                    <td>AC Service</td>
                                                    <td>Failed</td>
                                                    <td></td>
                                                    <td>Active</td>
                                                    <td class="text-truncate">
                                                        <ul class="actions">
                                                         <li><a href="#" title="View Service Request" data-toggle="modal" data-target="#customer_request"><i class="fa fa-eye" aria-hidden="true"></i></a></li>
                                                         <li><a href="" title="View Service Detail"><i class="fa fa-eye" aria-hidden="true"></i></a></li>
                                                         <li><a href="" title="View Customer Detail"><i class="fa fa-eye" aria-hidden="true"></i></a></li>
                                                         <li><a href="#" title="Download Invoice"><i class="fa fa-download" aria-hidden="true"></i></a></li>
                                                        </ul>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </div>
</div>
<!-- Process Refunds Modal -->
<div id="customer_request" class="modal fade in" role="dialog">
    <div class="modal-dialog modal-lg">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">View Customer Request</h4>
        <button type="button" class="close" data-dismiss="modal" style="margin-top:-25px;">×</button>
      </div>

      <!-- Modal body -->
      <div class="modal-body customer">
       <section class="msger">
          <header class="msger-header">
            <div class="msger-header-title">
             <img src="https://eagledemo.xyz/opalmarketings/storage/profile/edln4trZYwvYlnMkSnNFDx80mkqtyeM1r5Q9M81M.jpg" style="width:60px">
            </div>
            <div class="msger-header-options">
                <span><strong>Customer Name-</strong> Roushan Kumar</span><br>
                <span><strong>Booking Id-</strong> #booking571416</span><br>
                <span><strong> Date &amp; Time-</strong> 16-12-2022 05:24 AM</span><br>
                <span><strong>Request Id-</strong>  ASD123  </span>
            </div>
          </header>
          <main class="msger-chat">
                  <div class="msg left-msg">
              <div class="msg-bubble">
                <div class="msg-info">
                  <div class="msg-info-name">Customer</div>
              </div>
                <div class="msg-text">
                                product quality bad <br>
                  not need of this product
                </div>
              </div>
            </div>
       </main>
        <!--<button type="button" class="btn btn-primary acceptbtn">   Accept Cancellation </button>-->
        <div id="msger">
           <form class="msger-inputarea" method="POST" action="">
        <textarea type="text" class="msger-input" placeholder="Enter your message..."></textarea>
        <button type="submit" class="msger-send-btn">Submit</button>
      </form> 
        </div>
       </section>
      </div>

    </div>
  </div>
  </div>

@include('admin.footer')