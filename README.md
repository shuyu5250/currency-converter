# 匯率轉換API

### 使用說明

- Clone Repository
- 使用Docker啟動服務
  ```bash
  cd currency-converter
  # 複製 環境參數設定檔
  cp .env.example .env
  # 安裝相依套件
  composer install
  # 產生Laravel用API KEY
  php artisan key:generate
  # 使用Docker 啟動服務
  vendor/bin/sail up
  ```
- 服務啟動後可用curl執行API請求
  ```
  curl -X POST --location "http://localhost/api/currency-convert" \
  -H "Accept: application/json" \
  -H "Content-Type: application/json" \
  -d "{
        \"source\": \"TWD\",
        \"target\": \"USD\",
        \"amount\": 1234
      }"
  ```
- 執行測試
  ```bash
  php artisan test
  ```

### API規格說明

[Swagger API預覽](https://app.swaggerhub.com/apis-docs/jack_lin/CurrencyConvert/1.0.0)

- 使用`POST`方法指向`/api/currency-convert`
- 需攜帶指定三個參數

| 欄位     | 型態     | 舉例   |
|--------|--------|------|
| source | string | TWD  |
| target | string | USD  |
 | amount | number | 1000 |
- 若成功，回傳狀態碼`200`，並呈現轉換後數字
  ```json
  {
    "dollars": 40.49
  }
  ```
- 若輸入欄位不符規格，回傳狀態碼`422`，並條列錯誤訊息
  ```json
  {
    "message": "The selected source is invalid.",
    "errors": {
      "source": ["The selected source is invalid."]
    }
  }
  ```
