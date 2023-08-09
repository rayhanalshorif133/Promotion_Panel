
$(function(){
    handleRatioErrorMsg();
    handleCampaignUrlCopyBtn();
});

const handleCampaignUrlCopyBtn = () => {
    $("#campaignUrlCopyBtn").click(function(){
        let url = $(this).attr("data-url");
        // copyToClipboard(url);
        $(this).find('.fa-copy').removeClass('fa-copy').addClass('fa-check');
        $(this).find('.fa-copy') && toastr.success('Copied to clipboard');
        navigator.clipboard.writeText(url);
        setTimeout(function(){
            $("#campaignUrlCopyBtn").find('.fa-check').removeClass('fa-check').addClass('fa-copy');
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