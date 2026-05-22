function update_brand(id) {
        fetch("brand/update_brand_model.php?id=" + id)
            .then(response => response.text())
            .then(data => {
                document.getElementById("update_brand").style.display = "flex";
                document.getElementById("update_content").innerHTML = data;
                const form = document.getElementById("update_data");
                if (form) {
                    form.addEventListener("submit", function (e) {
                        e.preventDefault();
                        let formData = new FormData(form);
                        fetch("brand/update_brand.php", {
                            method: "POST",
                            body: formData
                        })
                            .then(res => res.text())
                            .then(data => {
                                location.reload();
                            })
                            .catch(error => {
                                console.log("Eroor:", error);
                            })
                    })
                }
            })

    }
    function close_update() {
        document.getElementById("update_brand").style.display = "none";
    }
    let delete_id=null;
    function delete_brand(id) {
        delete_id=id;
        document.getElementById("delete_model").style.display="flex";
    }
    function final_delete() {
        fetch("brand/delete_brand.php?delete_id="+delete_id)
        .then(res=>res.text())
        .then(data=>{

            location.reload();
        })
    }
    function close_delete_model() {
        document.getElementById("delete_model").style.display="none";
    }
   
document.getElementById("brand_logo").addEventListener("change", function() {
    const fileName = this.files[0]?.name || "No file selected";
    document.getElementById("file-name").textContent = fileName;
});