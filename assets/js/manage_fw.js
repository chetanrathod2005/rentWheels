function view_fw(id) {
        fetch("four_wheeler/fw_crud/get_car.php?id="+id)
        .then(res=>res.text())
        .then(data=>{
            document.getElementById("view_model").style.display="flex";
            document.getElementById("view_content").innerHTML=data;
        })
    }
    function close_view_model() {
    document.getElementById("view_model").style.display="none";
    }

    function update_fw(id) {
    fetch("four_wheeler/fw_crud/update_fw.php?id=" + id)
    .then(res => res.text())
    .then(data => {
        document.getElementById("update_model").style.display = "flex";
        document.getElementById("update_content").innerHTML = data;

        // ✅ Attach event AFTER form is injected
        const form = document.getElementById("update_data");

        if (form) {
            form.addEventListener("submit", function(e) {
                e.preventDefault();

                let formData = new FormData(form);
               
                fetch("four_wheeler/fw_crud/update_fw_process.php", {
                    method: "POST",
                    body: formData
                })
                .then(res => res.text())
                .then(data => {
                    alert(data);
                    location.reload();
                })
                .catch(error => {
                    console.error("Error:", error);
                });
            });
        }
    });
}
    let delete_id=null;
    function delete_fw(id) {
        delete_id=id;
        document.getElementById("delete_model").style.display="flex";
    }
    function final_delete() {
        fetch("four_wheeler/fw_crud/delete_fw.php?delete_id="+delete_id)
        .then(res=>res.text())
        .then(data=>{
            console.log(data)
            location.reload();
        })
    }

    function close_update_modal() {
        document.getElementById("update_model").style.display="none";
    }

    

    function close_delete_model() {
        document.getElementById("delete_model").style.display="none";
    }

    // stop scrolling for number type
        document.addEventListener('wheel', function(e) {

        if (document.activeElement.type === 'number') {
            document.activeElement.blur();
        }

    }, { passive: true });
