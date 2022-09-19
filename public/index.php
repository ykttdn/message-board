<?php
session_start();
require_once(__DIR__.'/../src/db_connect.php');

if (isset($_POST['action_type']) && $_POST['action_type']) {
    if ($_POST['action_type'] === 'insert') {
        require(__DIR__.'/../src/insert_message.php');
    }
}

require(__DIR__.'/../src/session_values.php');

$stmt = $dbh->query('SELECT * FROM posts ORDER BY created_at DESC;');
$message_length = $stmt->rowCount();

function convert_time_zone($datetime_text) {
    $datetime = new DateTime($datetime_text);
    $datetime->setTimezone(new DateTimeZone('Asia/Tokyo'));
    return $datetime->format('Y/m/d H:i:s');
}
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
            <div class="message-list-cover">
                <small>
                    <?= $message_length; ?>件の投稿
                </small>

                <?php while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) { ?>
                    <?php $lines = explode('\n', $row['message']); ?>
                    <div class="message-item">
                        <div class="message-title">
                            <div>
                                <?= htmlspecialchars($row['author_name'], ENT_QUOTES); ?>
                            </div>
                            <small>
                                <?= convert_time_zone($row['created_at']); ?>
                            </small>
                            <div class="spacer"></div>
                            <form action="/" method="POST" style="text-align: right">
                                <input type="hidden" name="id" value="<?= $row['id']; ?>" />
                                <input type="hidden" name="action_type" value="delete" />
                                <button type="submit" class="message-delete-button">削除</button>
                            </form>
                        </div>
                        <?php foreach ($lines as $line) { ?>
                            <p class="message-line">
                                <?= htmlspecialchars($line, ENT_QUOTES); ?>
                            </p>
                        <?php } ?>
                    </div>
                <? } ?>
            </div>
        </div>
    </body>
</html>
