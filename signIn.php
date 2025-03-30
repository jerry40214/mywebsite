<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form id="submitForm">
        <label >username:</label><br>
        <input type="text" name="username"><br>
        <label >password:</label><br>
        <input type="password" name="password"><br>
        <button type="submit" >登入</button>
        <br>
    </form>
    <div id="result"></div> 
    <script>
         document.getElementById("submitForm").addEventListener("submit", function (e) {
            e.preventDefault();

            const username = this.username.value;
            const password = this.password.value;
            
            fetch("./signInIndex.php", {
                method: "POST",
                headers: {
                    "Content-Type": "application/json"
                },
                body: JSON.stringify({
                    username:username,
                    password:password
                })
            })
            .then(res => res.json())
            .then(data => {
                if(data.message === "登入成功!!!"){
                    window.location.href = "./createContent.php";
                }
                else{
                    document.getElementById("result").textContent =
                        data.error || "未知錯誤";
                }
            })
            .catch(err => {
                document.getElementById("result").textContent = "請求失敗";
                console.error(err);
            });
        });
    </script>
</body>
</html>