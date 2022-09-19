<?php
session_start();
require_once(__DIR__.'/../src/db_connect.php');

if (isset($_POST['action_type']) && $_POST['action_type']) {
    if ($_POST['action_type'] === 'insert') {
        require(__DIR__.'/../src/insert_message.php');
    }
}

require(__DIR__.'/../src/session_values.php');
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="robots" content="noindex" />
        <title>ひとこと掲示板</title>
        <link rel="stylesheet" href="./assets/main.css" />
    </head>
    <body>
        <div class="page-cover">
            <h1 class="page-title">ひとこと掲示板</h1>
            <hr class="page-divider" />
            <div class="form-cover">
                <form action="/" method="post">
                    <div class="form-input-title">
                        <label for="author_name">投稿者ニックネーム</label>
                    </div>
                    <input
                        type="text"
                        name="author_name"
                        id="author_name"
                        maxlength="40"
                        value="<?= htmlspecialchars($messages['input_pre_author_name'], ENT_QUOTES); ?>"
                        class="input-author-name"
                    />
                    <?php if ($messages['input_error_author_name'] !== '') { ?>
                        <div class="form-input-error">
                            <?= $messages['input_error_author_name']; ?>
                        </div>
                    <?php } ?>
                    <div class="form-input-title">
                        <label for="message">投稿内容<small>(必須)</small></label>
                    </div>
                    <textarea name="message" id="message" class="input-message"><?= htmlspecialchars($messages['input_pre_message'], ENT_QUOTES); ?></textarea>
                    <?php if ($messages['input_error_message'] !== '') { ?>
                        <div class="form-input-error">
                            <?= $messages['input_error_message']; ?>
                        </div>
                    <?php } ?>
                    <input type="hidden" name="action_type" value="insert" />
                    <button type="submit" class="input-submit-button">投稿する</button>
                </form>
            </div>
            <hr class="page-divider" />
            <div class="message-list-cover"></div>
        </div>
    </body>
</html>
