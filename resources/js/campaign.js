
$(function(){
    handleRatioErrorMsg();
    handleCampaignUrlCopyBtn();
    handleCampaignDeleteBtn();
    handleCampaignReportSearch();
});

const handleCampaignDeleteBtn = () => {
    $(".campaignDeleteBtn").click(function () {
        const id = $(this).parent().attr('data-id');
        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.isConfirmed) {
                axios.delete(`campaign/delete/${id}`)
                    .then(function (res) {
                        Swal.fire(
                            'Deleted!',
                            'Your file has been deleted.',
                            'success'
                        ).then((result) => {
                            location.reload();
                        });
                    });
                    
            }
        })
    });
}

const handleCampaignUrlCopyBtn = () => {
    $("#campaignUrlCopyBtn").click(function(){
        let url = $(this).attr("data-url");
        // copyToClipboard(url);
        navigator.clipboard.writeText(url);
        $(this).find('.fa-copy') && toastr.success('Copied to clipboard');
        $(this).find('.fa-copy').removeClass('fa-copy').addClass('fa-check');
        // data-bs-original-title
        $(this).attr('data-bs-original-title', 'Copied!').tooltip('show');
        setTimeout(function(){
            $("#campaignUrlCopyBtn").find('.fa-check').removeClass('fa-check').addClass('fa-copy');
            $("#campaignUrlCopyBtn").attr('data-bs-original-title', 'Copy to clipboard').tooltip('hide');
        }, 1000);
        console.log(url);
    });
}


const handleRatioErrorMsg = () => {
    $("#campaign_create_ratio").keyup(function(){
        let ratio = $(this).val();
        if(ratio > 1){
            $(this).val(1);
            $("#ratioErrorMsg").text("Ratio must be less than 1");
        }else{
            $("#ratioErrorMsg").text("");
        }
    });
}

const handleCampaignReportSearch = () => {
    $(".campaignReportSearchBtn").click(function(){
        var html = "";
        html += "<tr>";
        html += "<td class='text-center align-middle'>1</td>";
        html += "<td class='text-center align-middle'>2</td>";
        html += "<td class='text-center align-middle'>3</td>";
        html += "<td class='text-center align-middle'>4</td>";
        html += "</tr>";
        $(".campaignReportTableBody").html(html);
    });
}

