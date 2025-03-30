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
        <label >email:</label><br>
        <input type="email" name="email"><br>
        <label >password:</label><br>
        <input type="password" name="password"><br>
        <button type="submit">註冊</button>
        <br>
    </form>
    <div id="result"></div>
    <script>
         document.getElementById("submitForm").addEventListener("submit", function (e) {
            e.preventDefault();

            const username = this.username.value;
            const email = this.email.value;
            const password = this.password.value;
            
            fetch("./createUserIndex.php", {
                method: "POST",
                headers: {
                    "Content-Type": "application/json"
                },
                body: JSON.stringify({
                    username:username,
                    email:email,
                    password:password
                })
            })
            .then(res => res.json())
            .then(data => {
                if(data.message === "註冊完成!!"){
                    window.location.href = "./signIn.php";
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