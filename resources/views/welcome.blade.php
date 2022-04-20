@extends('shopify-app::layouts.default')

@section('content')


    <!-- You are: (shop domain name) -->

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('public/css/style.css') }}">
      <link rel="stylesheet" href="http://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">

<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.25/css/jquery.dataTables.css">  


    <p>You are: {{ $shopDomain ?? Auth::user()->name }}</p>
    
    <!-- drow table -->

        <div class="container">
        <div id="exTab1">
            <ul class="nav tabs">
                <li class="">
                    <a href="#1a" data-toggle="tab" class="active show">Dashboard</a>
                </li>
               <!--  <li><a href="#4a" data-toggle="tab">Set Order Ranges</a>
                </li> -->
                <li><a href="#2a" data-toggle="tab"> Order Details </a>
                </li>
                <li><a href="#3a" data-toggle="tab">Contact us</a>
                </li>
               
            </ul>

            <div class="tab-content clearfix">
                <div class="tab-pane active" id="1a">
                   @include('store.instruction')
                </div>
                <div class="tab-pane" id="2a">
                    @include('store.order_details')
                </div>
                <div class="tab-pane" id="3a">
                    @include('store.contact_details')
                </div>
                <!--   <div class="tab-pane" id="4a">
                    @include('store.set_orderRagnes')
                </div> -->
              
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    @parent
        
    <script>
        actions.TitleBar.create(app, { title: 'Welcome' });
    </script>

     <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

     <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>    

    
       <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/datatables/1.10.21/js/jquery.dataTables.min.js"></script>
        
         <script src="http://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.0.2/js/toastr.min.js"></script>
   
    
  
    
    <script>
        $(document).ready(function () {
            $('#dtBasicExample').DataTable();
            $('.dataTables_length').addClass('bs-select');
        });
    </script>

    
    <script type="text/javascript">
        
        $("#email_send").click(function() {


        var email_address =  $('#email_address').val();
        var name =  $('#name').val();
        var message =  $('#message').val();
        var subject =  $('#subject').val();

        if(email_address=='') {

            alert('please fill the email field!');
            return false;

        } else if(name=='') {
            
            alert('please fill the name field!');
            return false;

        } else if(message=='') {

            alert('please fill the message field!');
            return false;
        } else if(subject=='') {

            alert('please fill the subject field!');
            return false;
        } 

        else {

                $("#email_send").prop('disabled', true); //disable 
                var postData=new FormData();
                            
                    postData.append('email_address',email_address);
                    postData.append('name',name);
                    postData.append('subject',subject);
                    postData.append('message',message);

                    var url="{{ url('email-sent') }}";

                       $.ajax({
                        headers:{'X-CSRF-Token':$('meta[name=csrf_token]').attr('content')},
                        type:"post",
                        url:url,
                        data:postData,
                        processData: false,
                        contentType: false,
                        success:function(response){
                           // alert(response);
                          console.log(response);
                           toastr.info('Thanks! Your  Email has been sent!');
                           
                            setTimeout(function() {
                                $("#email_send").prop('disabled', false); //disable 
                            }, 2000);
                    
                        }
                    });
            }
       



        });
    </script>



     <script type="text/javascript">
        
        $("#set_order_submitbutton").click(function() {


        var initial_order_number =  $('#initial_order_number').val();
        var last_order_number =  $('#last_order_number').val();

        var check_initial_order_number = $.isNumeric(initial_order_number);

        var check_last_order_number = $.isNumeric(last_order_number);

           
        if (!check_initial_order_number) {

            alert('Please enter the numeric value in initial number field');
            return false;

        } else if(!check_last_order_number) {

            alert('Please enter the numeric value in last number field');
            return false;

        } else {

              $("#set_order_submitbutton").prop('disabled', true); //disable 
           var url="{{ url('sent-order') }}";

            var postData=new FormData();
                    
            postData.append('initial_order_number',initial_order_number);
            postData.append('last_order_number',last_order_number);
       

             $.ajax({
                    headers:{'X-CSRF-Token':$('meta[name=csrf_token]').attr('content')},
                    type:"post",
                    url:url,
                    data:postData,
                    processData: false,
                    contentType: false,
                    success:function(response){
                        alert(response);
                      console.log(response);
                       toastr.info('Thanks! Your Order  Ranges Is Set!');
                       
                        setTimeout(function() {
                            $("#set_order_submitbutton").prop('disabled', false); //disable 
                        }, 2000);
                
                    }
            });

        }

    });

</script>

    <script>
        actions.TitleBar.create(app, { title: 'Welcome' });
    </script>

@endsection