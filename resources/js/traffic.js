$(function () {
    $(".showTrafficDetailsBtn").click(function () {
        const id = $(this).parent().attr('data-id');
        axios.get(`traffic/fetch/${id}`)
            .then(function (res) {
                const data = res.data.data;

                
                $(".showClickedId").text(data.clicked_id);
                $(".showServiceName").text(data.service.name);
                $(".showOperatorName").text(data.operator.name);
                $(".showCampaignName").text(data.campaign.name);
                // obj to array
                const othersArr = Object.entries(data.others);
                var html = '';
                othersArr.length > 0 && othersArr.forEach(function (item) {
                    html += `<div><strong>${item[0]}</strong>:${item[1]}</div>`;
                });

                othersArr.length == 0 && (html = '<div class="text-left text-danger">No data</div>');



                $(".showCampaignOthers").html(html);
                $(".showReceivedAt").text(data.clicked_id);
                $(".showPostBackReceivedStatus").text(data.clicked_id);
                $(".showPostBackSentStatus").text(data.clicked_id);
            });
    });
});