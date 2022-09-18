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
            value=""
            class="input-author-name"
          />
          <div class="form-input-error"></div>
          <div class="form-input-title">
            <label for="message">投稿内容<small>(必須)</small></label>
          </div>
          <textarea name="message" id="message" class="input-message"></textarea>
          <div class="form-input-error"></div>
          <input type="hidden" name="action_type" value="insert" />
          <button type="submit" class="input-submit-button">投稿する</button>
        </form>
      </div>
      <hr class="page-divider" />
      <div class="message-list-cover">
        <small>
          1 件の投稿
        </small>
        <div class="message-item">
          <div class="message-title">
            <div>イチロー</div>
            <small>2022-01-01 00:00:00</small>
            <div class="spacer"></div>
            <form action="/" method="post" style="text-align:right">
              <input type="hidden" name="id" value="" />
              <input type="hidden" name="action_type" value="delete" />
              <button type="submit" class="message-delete-button">削除</button>
            </form>
          </div>
          <p class="message-line">明けましておめでとうございます</p>
        </div>
      </div>
      <hr class="page-divider" />
    </div>
  </body>
</html>
