@section('title')
    Liên Hệ
@endsection

@extends('index')

@section('content')
    <!-- Page Content -->
    <div class="container">

    	@include('block.slide')

        <div class="space20"></div>


        <div class="row main-left">
            @include('block.menu')

            <div class="col-md-9">
	            <div class="panel panel-default">
	            	<div class="panel-heading" style="background-color:#337AB7; color:white;" >
	            		<h2 style="margin-top:0px; margin-bottom:0px;">Liên hệ</h2>
	            	</div>

	            	<div class="panel-body">
	            		<!-- item -->
                        <h3><span class="glyphicon glyphicon-align-left"></span> Thông tin liên hệ</h3>

                        <div class="break"></div>
					   	<h4><span class= "glyphicon glyphicon-home "></span> Địa chỉ : </h4>
                        <p>Thành phố Huế </p>

                        <h4><span class="glyphicon glyphicon-envelope"></span> Email : </h4>
                        <p>lienhe@infor.com </p>

                        <h4><span class="glyphicon glyphicon-phone-alt"></span> Điện thoại : </h4>
                        <p>0123456789 </p>



                        <br><br>
                        <h3><span class="glyphicon glyphicon-globe"></span> Bản đồ</h3>
                        <div class="break"></div><br>
                        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d7652.156298196991!2d107.57479492436354!3d16.471580104533718!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3141a6d2bb530945%3A0xd50143719c2a23a1!2zMTEzLTkzIMSQxrDhu51uZyBUaOG6oWNoIEjDo24sIFRodeG6rW4gSG_DoCwgVGjDoG5oIHBo4buRIEh14bq_LCBUaOG7q2EgVGhpw6puIEh14bq_LCBWaeG7h3QgTmFt!5e0!3m2!1svi!2s!4v1593679339401!5m2!1svi!2s" width="600" height="450" frameborder="0" style="border:0;" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe>
					</div>
	            </div>
        	</div>
        </div>
        <!-- /.row -->
    </div>
    <!-- end Page Content -->
@endsection
