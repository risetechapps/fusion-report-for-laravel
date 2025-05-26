# Laravel Fusion Report

## 📌 Sobre o Projeto

**Laravel Fusion Report** é um package para Laravel que facilita a geração de relatórios via API.

## ✨ Funcionalidades

* 🔑 **Autenticação via API Key**
  Use uma chave gerada na sua conta para autenticar suas requisições.
* 🏽 **Geração de Relatórios**
  Suporta os formatos: `pdf`, `rtf`, `docx`, `odt`, `html`, `xml`, `xls`, `xlsx`, `csv`, `ods`, `pptx`, `xhtml`.

---

## 🚀 Instalação

### 1️⃣ Requisitos

* PHP >= 8.0
* Laravel >= 10
* Composer instalado

### 2️⃣ Instalação do Package

```bash
composer require risetechapps/fusion-report-for-laravel
```

### 3️⃣ Configuração

Adicione sua chave de API no arquivo `.env`:

```env
FUSION_REPORT_TOKEN=xxxxxxxxxxxx
```

---

## ✅ Registro das Rotas

Adicione isso ao seu `routes/api.php` ou provedor de rotas:

```php
use Illuminate\Support\Facades\Route;
use RiseTechApps\FusionReportLaravel\FusionReportLaravelFacade;

FusionReportLaravelFacade::routes([
    'middleware' => ['auth:sanctum']
]);
```

---

## 📤 Exemplo de Requisição

### 📥 Via Curl

```bash
curl -X POST http://localhost:8000/reports/generate \
  -H "Accept: application/json" \
  -H "Content-Type: application/json" \
  -d '{
    "id": "profile_company",
    "theme": "default",
    "queue": false,
    "locale": "pt-br",
    "format": ["pdf"],
    "data": []
  }'
```

### 📥 Via JavaScript (fetch)

```js
fetch('http://localhost:8000/reports/generate', {
  method: 'POST',
  headers: {
    'Content-Type': 'application/json',
    'Accept': 'application/json'
  },
  body: JSON.stringify({
    id: "profile_company",
    theme: "default",
    queue: false,
    locale: "pt-br",
    format: ["pdf"],
    data: []
  })
})
  .then(res => res.json())
  .then(data => console.log(data));
```

### 📬 Exemplo de Resposta

```json
{
  "success": true,
  "data": {
    "queue": false,
    "links": {
      "pdf": "https://ewr1.fusionreports.com/risetech/reports/public/..."
    }
  }
}
```

---

## ⏳ Execução em Segundo Plano

Para gerar o relatório em **segundo plano**, defina `"queue": true`.
Você poderá ouvir o evento `ReportGenerateEvent` para saber quando ele for concluído.

---

## ✉️ Envio por E-mail

Para **enviar o relatório por e-mail**, adicione os seguintes parâmetros ao corpo:

```json
{
  "send_email": true,
  "email": ["usuario@example.com"]
}
```

---

## 🛠 Contribuindo

1. Faça um fork do repositório
2. Crie uma branch: `feature/sua-feature`
3. Commit suas alterações
4. Envie um Pull Request

---

## 📜 Licença

Distribuído sob a licença [MIT](LICENSE).

---

💡 Desenvolvido por [Rise Tech](https://risetech.com.br)
