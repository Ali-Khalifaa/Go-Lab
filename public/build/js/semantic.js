
$('.box-custom').addClass('d-none')
$(document).ready(function () {
    $('.ui.dropdown').dropdown();

    $('#table_id').DataTable({
        'language' :{
            "url" : "https://cdn.datatables.net/plug-ins/1.10.24/i18n/Arabic.json"
        }
    });
    $('.ui.checkbox')
        .checkbox({
            onChecked() {
                const options = $('#members_dropdown > option').toArray().map(
                    (obj) => obj.value
                    
                );
               
                $('#members_dropdown').dropdown('set exactly', options);
            },
            onUnchecked() {
                $('#members_dropdown').dropdown('clear');
            },
    });
    
     $('.box-custom').hide() ; 
    $("select").change(function () {
        $("select").find("option:selected").each(function () {
                var optionValue = $(this).attr("value");
                // console.log(optionValue);
                // if (optionValue) {
                //     $("." + optionValue).show();
                //     // $("." + optionValue).css('background' , '#F00');
                // }
                
                // $(this).on('click' , () =>  {
                //     console.log('asda') ; 
                // })
            });
            
                    $("select").find("option:selected").each(function () {
                    $(this).click(() =>  {
                        console.log('asdfsa') ;
                    })
                

            });
            
            allOptions = $(this).val() ; 
            console.log(allOptions) ;
            
           
                
                function test(){
                {
                                
                    if(allOptions !== null  )
                    {
        
                        if( allOptions.length > 0)
                        {
                                                    
                        $(`.box-custom`).hide() ;
                        for(let i = 0 ; i < allOptions.length ; i++  )
                        {
                            // :not(.${allOptions[i]})
                            console.log($(`select option`));
                             $(`.${allOptions[i]}`).show() ;
                             
                        }
                        }else
                        {
                            $(`.box-custom`).hide() ;
                        }

                    }else
                    {
                        $(`.box-custom`).hide() ;
                    }

                }
                
                }
                test() ; 

    }).change();
    
    
    

    
    
    
            

});





