
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form id="submitForm">
        <label >content:</label><br>
        <input type="text" name="content"><br>
        <input type="submit" name="submit" value="上傳"><br>
    </form>
    <form id="searchForm">
        <label >username:</label><br>
        <input type="text" name="username"><br>
        <button type="submit">搜尋</button><br>
    </form>
    <form id="deleteForm">
        <label >id:</label><br>
        <input type="text" name="id"><br>
        <button type="submit">刪除</button>
    </form>
    <div>
        <form id="updateForm">
            <label >id:</label><br>
            <input type="text" name="id"><br>
            <label >text:</label><br>
            <input type="text" name="content"><br>
            <button type="submit">編輯</button>
        </form>
    </div>
    <div id="result"></div> 
    <script>
         document.getElementById("submitForm").addEventListener("submit", function (e) {
            e.preventDefault();

            const content = this.content.value;

            fetch("./createContentIndex.php", {
                method: "POST",
                headers: {
                    "Content-Type": "application/json"
                },
                body: JSON.stringify({
                    type : "forSubmit",
                    content : content
                })
            })
            .then(res => res.json())
            .then(data => {
                document.getElementById("result").textContent =
                    data.message || data.error || "未知錯誤";
            })
            .catch(err => {
                document.getElementById("result").textContent = "請求失敗";
                console.error(err);
            });
        });
    </script>
    <script>
         document.getElementById("searchForm").addEventListener("submit", function (e) {
            e.preventDefault();

            const username = this.username.value;

            fetch("./createContentIndex.php", {
                method: "POST",
                headers: {
                    "Content-Type": "application/json"
                },
                body: JSON.stringify({
                    type : "forSearch",
                    username : username
                })
            })
            .then(res => res.json())
            .then(data => {
                const resultBox = document.getElementById("result");
                if (Array.isArray(data) && data.length > 0) {
                    resultBox.innerHTML = data.map(item => `
                        <div style="padding: 10px; border-bottom: 1px solid #ddd;">
                            <strong>${item.username}</strong> <br>
                            <p>${item.content}</p>
                            <small>${item.content_date}</small>
                        </div>
                    `).join("");
                } else {
                    resultBox.textContent = data.error || data.message || "查無資料";
                }
            })
            .catch(err => {
                document.getElementById("result").textContent = "請求失敗";
                console.error(err);
            });
        });
    </script>
    <script>
        document.getElementById("updateForm").addEventListener("submit", function (e) {
            e.preventDefault();

            const id = this.id.value;
            const content = this.content.value;

            fetch("./createContentIndex.php", {
                method: "PUT",
                headers: {
                    "Content-Type": "application/json"
                },
                body: JSON.stringify({
                    id: id,
                    content: content
                })
            })
            .then(res => res.json())
            .then(data => {
                document.getElementById("result").textContent =
                    data.message || data.error || "未知錯誤";
            })
            .catch(err => {
                document.getElementById("result").textContent = "請求失敗";
                console.error(err);
            });
        });
    </script>
    <script>
        document.getElementById("deleteForm").addEventListener("submit", function (e) {
            e.preventDefault();

            const id = this.id.value;

            fetch("./createContentIndex.php", {
                method: "DELETE",
                headers: {
                    "Content-Type": "application/json"
                },
                body: JSON.stringify({
                    id: id,
                })
            })
            .then(res => res.json())
            .then(data => {
                document.getElementById("result").textContent =
                    data.message || data.error || "未知錯誤";
            })
            .catch(err => {
                document.getElementById("result").textContent = "請求失敗";
                console.error(err);
            });
        });
    </script>
</body>
</html>
