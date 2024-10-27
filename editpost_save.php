<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <title>Edit Post</title>
</head>

<body>
    <div class="container">
        <h1 style="text-align: center ; color:pink;" class="mt-3">คาเฟ่ เเมวไม่ได้นอน 🐱</h1>
        <?php include "nav.php" ?>
        
        
        <?php if (isset($_GET['success']) && $_GET['success'] == 1): ?>
            <div class="alert alert-success text-center" role="alert">
                แก้ไขข้อมูลเรียบร้อยแล้ว
            </div>
        <?php endif; ?>
        
        
        <div class="edit-form mt-5">
            <h3 class="text-center text-warning">แก้ไขกระทู้</h3>
            <form method="POST" action="editpost_save.php">
                <div class="mb-3">
                    <label for="category" class="form-label">หมวดหมู่</label>
                    <select id="category" name="category" class="form-select">
                        <?php foreach ($categories as $category): ?>
                            <option value="<?php echo $category['id']; ?>" <?php echo $current_post['cat_id'] == $category['id'] ? 'selected' : ''; ?>>
                                <?php echo $category['name']; ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="title" class="form-label">หัวข้อ</label>
                    <input type="text" id="title" name="title" class="form-control" value="<?php echo $current_post['title']; ?>" required>
                </div>
                <div class="mb-3">
                    <label for="content" class="form-label">เนื้อหา</label>
                    <textarea id="content" name="content" class="form-control" rows="5" required><?php echo $current_post['content']; ?></textarea>
                </div>
                <input type="hidden" name="post_id" value="<?php echo $current_post['id']; ?>">
                <button type="submit" class="btn btn-warning w-100">บันทึกข้อความ</button>
            </form>
        </div>
    </div>
</body>

</html>
