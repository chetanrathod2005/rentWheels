        function update_tw(id) {
            fetch("two_wheeler/tw_crud/update.php?id="+id)
            .then(response=>response.text())
            .then(data=> {
            document.getElementById("update_model").style.display="flex";
             document.getElementById("update_content").innerHTML=data;
             const form=document.getElementById("update_data");
             if(form) {
                form.addEventListener("submit", function (e) {
                    e.preventDefault();
                    let formData=new FormData(form);
                fetch("two_wheeler/tw_crud/update_process.php",{
                    method:"POST",
                    body:formData
                })
                .then(res=>res.text())
                .then(data=>{
                    alert(data)
                    location.reload();
                })
                .catch(error=>{
                    console.log("Eroor:",error);
                })
                })
             }
            })
           
        }
        
        function close_update_modal() {
            document.getElementById("update_model").style.display = "none";
        }

        let delete_id=null;
        function delete_tw(id) {
        delete_id=id;
         document.getElementById("delete_model").style.display="flex";
          
        }
        function final_delete() {
         fetch("two_wheeler/tw_crud/delete_tw.php?delete_id="+ delete_id)
         .then(res=>res.text())
         .then(data=> {
            console.log(data);
            location.reload();
         })
        }

        function view_tw(id) {
        fetch("two_wheeler/tw_crud/get_bike.php?id="+id)
        .then(response=>response.text())
        .then(data=> {
            document.getElementById("view_model").style.display="flex";
            document.getElementById("view_content").innerHTML=data;
        })
        }
        function closemodel() {
            document.getElementById("view_model").style.display="none";
        }
        function cancel_delete() {
            document.getElementById("delete_model").style.display="none";
        }
        
// stop scrolling for number type
        document.addEventListener('wheel', function(e) {

            if (document.activeElement.type === 'number') {
                document.activeElement.blur();
            }

        }, { passive: true });
