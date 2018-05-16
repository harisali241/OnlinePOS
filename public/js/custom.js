
var formsubmit = 0;
$('#company_submit').on('submit',function (e) {

    var company_name = $('#company_name').val();
    var company_phoneNo = $('#company_phoneNo').val();
    var company_address = $('#company_address').val();
    if(formsubmit === 0)
    {
        e.preventDefault();

        if(company_name === '')
        {
            swal({
                title: "Required!",
                text: "PLease Enter Company Name!",
                confirmButtonColor: "#0098a3",
            });
        }



        else if(company_phoneNo === '')
        {
            swal({
                title: "Required!",
                text: "PLease Enter Phone No!",
                confirmButtonColor: "#0098a3",
            });
        }

        else if(company_address === '')
        {
            swal({
                title: "Required!",
                text: "PLease Enter Address!",
                confirmButtonColor: "#0098a3",
            });
        }

        else{

            formsubmit = 1;
            $(this).submit();
        }
    }


});