
$(function(){
    handleRatioErrorMsg();
    handleCampaignUrlCopyBtn();
});

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