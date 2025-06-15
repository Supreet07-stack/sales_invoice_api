# Sales Invoice API

A Laravel-based API that allows uploading a sales invoice with one or more invoice lines, 
and then "forwards" this invoice to Exact Online via a service class

## 🚀 Getting Started

### Prerequisites

- PHP >= 8.1
- Composer
- SQLite (or configure `.env` for your preferred DB)
- Pest (for feature and tests)

### Installation

```bash
git clone https://github.com/Supreet07-stack/sales_invoice_api.git
cd sales_invoice_api
composer install
cp .env.example .env
php artisan key:generate
php artisan migrate
```

### Running Tests


 -- php artisan test


## 🧱 Architecture Overview

- Routes: Defined in 'routes/api.php'
- Validation: Done using 'StoreSalesInvoiceRequest'
- DTO: 'SalesInvoiceDTO' ensures strict typing and clarity in service communication
- Service Layer: 'SalesInvoiceService' contains core logic and coordinates tasks
- Repository Layer: 'SalesInvoiceRepository' handles DB persistence inside transactions
- External Service Simulation: 'ExactOnlineService' logs structured payloads

