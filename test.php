<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="./public/css/style-reset.css">
    <link rel="stylesheet" href="./public/css/dashboard.css">
</head>

<body>

    <button type="button" id="finalize-btn"></button>
    <div class="preview-exam hidden">
        <div class="preview-content hidden">
            <h2 class="text-center">Exam Preview</h2>
            <div class="preview-btns flex gap-4">
                <button type="button" id="done-preview">Done</button>
                <button type="button" id="cancel-preview">Cancel</button>
            </div>
            <div class="preview-question-list"></div>
        </div>
        <div class="edit-modal">
            <textarea id="edit-question-prompt" cols="30" rows="10"></textarea>
            <div class="edit-btns">
                <button type="button" id="done-edit">Done</button>
                <button type="button" id="cancel-edit">Cancel</button>
                <button type="button" id="add-choice-edit">Add Choice</button>
            </div>
            <div class="edit-choice-list"></div>
        </div>
    </div>

    <script src="test.js" type="module"></script>
</body>

</html>