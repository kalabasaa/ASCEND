# Ascend Database Structure

**Total: 10 Entities**

1. **USERS**  
   `id, name, email, password, role, created_at, updated_at`

2. **MEMBERS**  
   `id, member_id, user_id, first_name, last_name, phone, address, gender, created_at, updated_at`

3. **TRAINERS**  
   `id, first_name, last_name, phone, email, specialization, status, created_at, updated_at`

4. **MEMBERSHIP_PLANS**  
   `id, trainer_id, name, description, duration_days, price, status, created_at, updated_at`

5. **MEMBER_SUBSCRIPTIONS**  
   `id, member_id, membership_plan_id, start_date, end_date, amount, status, created_at, updated_at`

6. **PAYMENTS**  
   `id, payment_type, subscription_id, sale_id, amount, payment_method, payment_date, reference_number, created_at, updated_at`

7. **PRODUCTS**  
   `id, name, description, category, price, stock_quantity, low_stock_threshold, status, created_at, updated_at`

8. **SALES**  
   `id, member_id, user_id, sale_date, total_amount, status, created_at, updated_at`

9. **SOLD_PRODUCTS**  
   `id, sale_id, product_id, quantity, unit_price, subtotal, created_at, updated_at`

10. **GYM_VISITS**  
    `id, member_id, check_in, created_at, updated_at`