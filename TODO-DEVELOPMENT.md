# Development Plan for Deposits & New Transaction

**Status: 🟡 Pending Migrations**

## Deposits Migration
```
Fields needed:
- amount (decimal, required)
- nature_of_payment (string, required)
- cheque_number (string, nullable)
- specific_fund (string, required - dropdown)
- payee_name (string, required)
- deposit_date (datetime, required)

Current deposits table status unknown - needs exact schema
```

## New Transaction Migration
```
Records table already exists (from import)
Add fields if needed: type (income/expense), category
Already has: name, amount, date, user_id
```

## Steps:
1. ✅ Deposits schema migration (exact fields)
2. ✅ New Transaction SPA (/transactions) 
3. 🔄 Run migrations
4. 🔄 Update sidebar links
5. ✅ Test AJAX + validation

**Next:** Create migrations + migrate
