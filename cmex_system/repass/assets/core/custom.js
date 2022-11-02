
// [ton][23/04/2564][add script backtoindex for recruit view]
function goback_index(){
    if(url_index != undefined) window.location.href=url_index;
}

// ------------------------------ [form delete] ------------------------------
	function del_publish(url,publish_hd_id,numot){
        
		swal({ title: "คุณจะลบข้อมูลหรือไม่ ?",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#DD6B55",
                confirmButtonText: "ใช้, ลบข้อมูล !",
                cancelButtonText: "ยกเลิก",
                closeOnConfirm: false,
                closeOnCancel: false,
                timer: 6500
        },function(isConfirm){
        	if(isConfirm){
                var path= publish_hd_id+"/"+numot;
                //console.log(url+path);
                $.ajax({
                    type:"POST",
                    url:url+path,
                    dataType:'text', //dataType:'json',
                    cache:false,
                    contentType:false,
                    processData:false,
                    success:function(response){
                        // console.log(response); console.log("delete_status : "+response["delete_status"]);
                        if(!response["delete_status"]){
                            swal({title: 'ลบข้อมูลเรียบร้อยแล้ว !',text: 'คลิกปุ่ม OK เพื่อกลับสู่หน้าหลัก',type: 'success',timer: 6500});
                            setTimeout(function(){document.location.reload(true);} , 4500);
                        }
                    },error: function (xhr, textStatus, errorThrown,response){
                        alert("Get deleteRecruitProcess\nStatus: " + textStatus + '\nError: ' + errorThrown + '\nFunction: deleteRecruitProcess');
                    }
                });
        	}else{swal("ยกเลิก", "ยกเลิก การลบเรียบร้อย !", "success", 6500);}
        });

	}
    