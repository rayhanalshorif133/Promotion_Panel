$(function () {
    $(".showTrafficDetailsBtn").click(function () {
        const id = $(this).parent().attr('data-id');
        axios.get(`traffic/fetch/${id}`)
            .then(function (res) {
                const data = res.data.data;
                console.log(data);
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

                // received traffic 
                var receivedTraffic =  moment(data.received_at).format('MMMM Do YYYY, h:mm:ss a');
                $(".showReceivedAt").text(receivedTraffic);
                var postBackReceivedStatus = data.callback_received_status == 1 ? 'success' : 'failed';
                var postBackSentStatus = data.callback_sent_status == 1 ? 'sent' : 'not sent';
                $(".showPostBackReceivedStatus").text(postBackReceivedStatus);
                $(".showPostBackSentStatus").text(postBackSentStatus);
            });
    });

    $(".trafficDeleteBtn").click(function () {
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
                axios.delete(`traffic/delete/${id}`)
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
});