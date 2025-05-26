# Laravel Fusion Report

## 📌 Sobre o Projeto
O **Laravel Fusion Report** é um package para Laravel para facilitar as requições api gerar relatórios.

## ✨ Funcionalidades
- 🔑 **Autenticação via Chave Api** usando uma chave api gerado na sua conta você consegue fazer requisições api
- 🏷 **Gerar Relatórios nos formatos:** você pode gerar relatórios em pdf, rtf, docx, odt, html, xml, xls, xlsx, csv, ods, pptx e xhtml

---

## 🚀 Instalação

### 1️⃣ Requisitos
Antes de instalar, certifique-se de que seu projeto atenda aos seguintes requisitos:
- PHP >= 8.0
- Laravel >= 10
- Composer instalado

### 2️⃣ Instalação do Package
Execute o seguinte comando no terminal:
```bash
  composer require risetechapps/fusion-report-for-laravelfusion-report-for-laravel
```

### 3️⃣ Crie a Variável e coloque o seu token
```bash
  FUSION_REPORT_TOKEN=xxxxxxx
```

## ✅ Registrando Rota


```php
<?php

use Illuminate\Support\Facades\Route;

RiseTechApps\FusionReportLaravel\FusionReportLaravelFacade::routes(['middleware' => ['auth:sanctum']]);
```

### 📥 Exemplo de Requisição via Curl

Esse exemplo envia um corpo JSON para gerar relatórios, o id é o tipo de relatório que você deseja gerar, o theme é o tema do relatório, locale é o idioma, format é o formato do relatório e data são os dados que serão utilizados no relatório.

```curl
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

### 📥 Exemplo de Requisição via JavaScript (fetch)

Esse exemplo envia um corpo JSON para gerar relatórios, o id é o tipo de relatório que você deseja gerar, o theme é o tema do relatório, locale é o idioma, format é o formato do relatório e data são os dados que serão utilizados no relatório.
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




#### Exemplo de Resposta:
```json
{
    "success": true,
    "data": {
        "queue": false,
        "links": {
            "pdf": "https://ewr1.fusionreports.com/risetech/reports/public/55ca10c5-a7a0-433c-ad9b-cfd0d2ea90f8/01JW70WPQ0T8H0PFX5MVQEHV2S/Company%20-%20Profile.pdf"
        }
    }
}
```


## 🛠 Contribuição
Sinta-se à vontade para contribuir! Basta seguir estes passos:
1. Faça um fork do repositório
2. Crie uma branch (`feature/nova-funcionalidade`)
3. Faça um commit das suas alterações
4. Envie um Pull Request

---

## 📜 Licença
Este projeto é distribuído sob a licença MIT. Veja o arquivo [LICENSE](LICENSE) para mais detalhes.

---

💡 **Desenvolvido por [Rise Tech](https://risetech.com.br)**

