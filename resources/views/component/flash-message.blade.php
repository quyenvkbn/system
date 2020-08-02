<style>
	#message-alert{
		position: fixed;
		bottom: 0px;
		right: 15px;
		z-index: 999999999;
		min-width: 200px;
		max-width: 100%;
	}
	#message-alert strong{
		padding-right: 20px;
	}
	#message-alert .alert {
	    position: relative;
	    padding: 14px 15px;
	    margin-bottom: 15px;
	    border: 1px solid transparent;
	    border-radius: 5px;
	}
	#message-alert .alert .close{
		color: #000;
		opacity: .2;
		padding: 0;
	    background-color: transparent!important;
	    border: 0;
	    -webkit-appearance: none;
	    -moz-appearance: none;
	    appearance: none;
	    float: right;
	    font-size: 24px;
	    font-weight: 700;
	    line-height: 1;
	    color: #000;
	    text-shadow: 0 1px 0 #fff;
	    width: auto;
	    height: auto;
	}
	#message-alert .alert .close:hover{
		opacity: .5
	}
	#message-alert .alert a {
		color: #fff;
		text-decoration: underline
	}
	#message-alert .alert-success {
		color: #fff;
		background: #28a745;
		border-color: #23923d
	}
	#message-alert .alert-info {
		color: #fff;
		background: #17a2b8;
		border-color: #148ea1
	}
	#message-alert .alert-warning {
		color: #1f2d3d;
		background: #ffc107;
		border-color: #edb100
	}
	#message-alert .alert-danger {
		color: #fff;
		background: #dc3545;
		border-color: #d32535
	}
</style>

<div id="message-alert">
	@if ($message = Session::get('success'))
		<div class="alert alert-success alert-block">
		    <button type="button" class="close" data-dismiss="alert">×</button>    
		    <strong>{{ $message }}</strong>
		</div>
	@endif
	  
	@if ($message = Session::get('error'))
		<div class="alert alert-danger alert-block">
		    <button type="button" class="close" data-dismiss="alert">×</button>    
		    <strong>{{ $message }}</strong>
		</div>
	@endif
	   
	@if ($message = Session::get('warning'))
		<div class="alert alert-warning alert-block">
		    <button type="button" class="close" data-dismiss="alert">×</button>    
		    <strong>{{ $message }}</strong>
		</div>
	@endif
	   
	@if ($message = Session::get('info'))
		<div class="alert alert-info alert-block">
		    <button type="button" class="close" data-dismiss="alert">×</button>    
		    <strong>{{ $message }}</strong>
		</div>
	@endif
</div>

<script>
	document.addEventListener("DOMContentLoaded", function(){
		setTimeout(function(){
			$('#message-alert .alert').remove();
		},15000)
	});
</script>