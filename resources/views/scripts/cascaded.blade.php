<script src="{{ asset('js/jquery-3.3.1.slim.min.js') }}"></script>
        
    <script type="application/javascript">
        
            function withProperty(){       
            
            var property_id= $("#in_property_id").val();
            //alert('hello');
                    jQuery.ajax({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                          },
                          beforeSend: function(xhr){
                            if (xhr.overrideMimeType)
                            {
                              xhr.overrideMimeType("application/json");
                            }
                          },
                       type:'POST',
                       url:'/property-units',
                       data:{_token:'<?php echo csrf_token() ?>',
                                property_id:property_id,
                                },
                       success:function(data){
                           $('#inUnitContent').html(data);
                       
                        },
                        error: function (error) {
                                $('#inUnitContent').html('Property has no Units');
                                $('#monthly_rent').val(0);
                           $('#balance_bf').val(0);
                        }
                       
                    });
             }
             function getRentAmmount(){       
            
            var unit_id= $("#in_unit_id").val();
            
            if(unit_id==='xxx'){
              $('#monthly_rent').val('---------');
            }else{
                    jQuery.ajax({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                          },
                          beforeSend: function(xhr){
                            if (xhr.overrideMimeType)
                            {
                              xhr.overrideMimeType("application/json");
                            }
                          },
                       type:'POST',
                       url:'/unit-rentCharge',
                       data:{_token:'<?php echo csrf_token() ?>',
                                id:unit_id,
                                },
                       success:function(data){
                         //alert(data);
                           if(data !== null){
                           $('#monthly_rent').val(data.rent_charge);
                           $('#balance_bf').val(data.balance_bf);
                           }
                        },
                        error: function (error) {
                           $('#monthly_rent').val(0.00);
                           $('#balance_bf').val(0);
                        }
                       
                    });
             }
             }

             function paymentMode(){
               var pymntMode= $('#payment_mode').val();
               var html='';
               if(pymntMode=='1'){//cash
                html='<label for="payment_mode_value" class="col-md-4 col-form-label text-md-left">Receipt Number</label><div class="col-md-8"><input id="payment_mode_value" type="text" class="form-control" name="payment_mode_value" required autocomplete="payment_mode_value"/></div>';
                

               }else if(pymntMode=='2'){//mpesa
               html='<label for="payment_mode_value" class="col-md-4 col-form-label text-md-left">Mpesa Transaction ID</label><div class="col-md-8"><input id="payment_mode_value" type="text" class="form-control" name="payment_mode_value" required autocomplete="payment_mode_value" /></div>';

               }else if(pymntMode=='3'){//cheque
                html='<label for="payment_mode_value" class="col-md-4 col-form-label text-md-left">Cheque Number</label><div class="col-md-8"><input id="payment_mode_value" type="text" class="form-control" name="payment_mode_value" required autocomplete="payment_mode_value" /></div>';
               }else{//card
                html='<label for="payment_mode_value" class="col-md-4 col-form-label text-md-left">Card Receipt Number</label><div class="col-md-8"><input id="payment_mode_value" type="text" class="form-control" name="payment_mode_value" required autocomplete="payment_mode_value" /></div>';

               }
                $('#PaymentMode').html(html);

             }

             function getAmtPayable(){
               var amt_payable= $("#amt_payable");
               var bf= $("#balance_bf").val();
               var bcf= $("#balance_cf").val();
               var monthly_rent= parseInt($("#monthly_rent").val());

               if(bf==='' || bf===null || bf===undefined){
                 bf=0;
               }else{
                 bf=parseInt(bf);
               }

               if(bcf==='' || bcf===null || bcf===undefined){
                 bcf=0;
               }else{
                 bcf=parseInt(bcf);
               }

              var ap = (bf+monthly_rent)-bcf;
              amt_payable.val(ap);


             }
             
        
 </script>