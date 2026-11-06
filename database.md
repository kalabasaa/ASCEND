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


    users — accounts for login (admin or member), tracks streaks
id, username, email, password, role, avatar_path, tags, current_streak, longest_streak, last_checked_in_at, remember_token, timestamps

members — gym member profile, optionally linked to a user account
id, member_id, user_id (nullable, unique, nullOnDelete), first_name, last_name, phone, address, gender, timestamps

trainers — staff who create/own membership plans
id, first_name, last_name, phone, email, specialization, status, timestamps

membership_plans — subscription plan templates, optionally tied to a trainer
id, trainer_id (nullable), name, description, duration_days, price, status, timestamps

member_subscriptions — a member’s purchase of a specific plan
id, member_id, membership_plan_id, start_date, end_date, amount, status, timestamps

products — shop inventory items
id, name, description, category, price, stock_quantity, low_stock_threshold, status, timestamps

sales — a transaction record (product purchase), by a member, recorded by a staff user
id, member_id (nullable), user_id, sale_date, total_amount, status, timestamps

sold_products — line items within a sale
id, sale_id, product_id, quantity, unit_price, subtotal, timestamps

gym_visits — check-in log, one per member per day
id, member_id, check_in, visit_date (generated, unique with member_id), timestamps

payments — payment record for either a subscription or a sale
id, payment_type, subscription_id (nullable), sale_id (nullable), amount, payment_method, payment_date, reference_number, timestamps