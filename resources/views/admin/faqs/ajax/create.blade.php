<div class="modal-dialog">
    <!-- Modal content-->
    <div class="modal-content">
        <form class="form form-horizontal" id="addfaq" method="POST" action="{{ route('admin.manage-faq.store') }}" enctype="multipart/form-data">
            @csrf
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Add</h4>
            </div>
            <div class="modal-body">
                <div class="form-group row">
                    <div class="col-sm-12">
                        <label class="label-control label">FAQ category<span class="required">*</span></label>
                        <select class="form-control" name="faq_category" >
                            <option value="">Select</option>
                            @if (isset($faq_categories) && count($faq_categories) > 0)
                                @foreach ($faq_categories as $faq_category)
                                    <option value="{{ $faq_category->id }}">{{ $faq_category->name }}</option>
                                @endforeach
                            @endif
                        </select>
                        <div class="text-danger" id="faq_category-err"></div>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-12">
                        <label class="label-control label">Question <span class="required">*</span></label>
                        <textarea class="form-control" name="question" cols="30" rows="10" ></textarea>
                        <div class="text-danger" id="question-err"></div>
                    </div>
                </div>
                @if($language)
                <div class="form-group row">
                    <div class="col-sm-12">
                        <label class="label-control label">Question Ar<span class="required">*</span></label>
                        <textarea class="form-control" name="question_ar" cols="30" rows="10" ></textarea>
                        <div class="text-danger" id="question_ar-err"></div>
                    </div>
                </div>
                @endif
                <div class="form-group row">
                    <div class="col-sm-12">
                        <label class="label-control label">Answer <span class="required">*</span></label>
                        <textarea class="form-control" name="answer" cols="30" rows="10" ></textarea>
                        <div class="text-danger" id="answer-err"></div>
                    </div>
                </div>
                @if($language)
                <div class="form-group row">
                    <div class="col-sm-12">
                        <label class="label-control label">Answer Ar<span class="required">*</span></label>
                        <textarea class="form-control" name="answer_ar" cols="30" rows="10" ></textarea>
                        <div class="text-danger" id="answer_ar-err"></div>
                    </div>
                </div>
                @endif
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary add-faq-btn">Add</button>
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </form>
    </div>
</div>
