# Ascend Development Documentation

## Project Overview

Ascend is a gym management system designed to help administrators manage gym operations and allow members to access their membership information and gym services.

The system has two main areas:

- **Admin Panel:** Manages members, trainers, membership plans, subscriptions, payments, products, sales, and gym visits.
- **Member Panel:** Allows members to view their dashboard, membership, shop, visit history, and profile.

## Project Timeline

### November 1, 2026: Research

The initial stage focused on researching the project concept, understanding the requirements of a gym management system, and identifying the features needed for administrators and members.

The research helped establish the project's purpose and provided an initial direction for development.

### November 5, 2026: Project Planning

This stage focused on organizing the project before starting implementation.

**Database Design**

The database was planned around the main operations of the gym.

| Table | Purpose |
|---|---|
| `users` | Stores login credentials and user roles. |
| `members` | Stores member information linked to a user account. |
| `trainers` | Stores trainer information and specialization. |
| `membership_plans` | Stores available gym membership plans and assigned trainers. |
| `member_subscriptions` | Records membership purchases, dates, amounts, and status. |
| `payments` | Records completed membership and product payments. |
| `products` | Stores product information, prices, and stock quantities. |
| `sales` | Records product transactions. |
| `sold_products` | Stores individual products included in each sale. |
| `gym_visits` | Records member check-ins without checkout times. |

**Important Database Decisions**

- Each member account is connected to a user account.
- Membership plans can be associated with trainers.
- Payments distinguish membership and product transactions through `payment_type`.
- Payment records are created only for completed payments.
- Gym visits record check-ins only.
- A member can check in only once per calendar day.
- Historical visit records are preserved.

**Authentication**

Ascend uses Laravel Breeze and Laravel Fortify.

- **Laravel Breeze:** Provides authentication starter scaffolding and frontend authentication views, depending on the selected stack.
- **Laravel Fortify:** Handles backend authentication functionality, including login, registration, logout, and password management.
- **Role-based middleware:** Separates administrator and member access.

**Application Architecture**

Ascend follows Laravel's MVC architecture.

- **Model:** Represents database entities and manages database interactions through Eloquent.
- **View:** Displays the interface using Blade.
- **Controller:** Handles incoming requests and coordinates application logic.

The detailed directory structure and application organization are maintained in `ARCHITECTURE.md`.

**Development Decisions**

Admin Panel:
- Use a desktop-oriented layout.
- Use a left navigation area, main content area, and details or form area where appropriate.

Member Panel:
- Prioritize mobile-friendly layouts.
- Use bottom navigation for Home, Membership, Shop, Visits, and Profile.
- Keep the interface simple and accessible.

Landing Page:
- Create a public landing page for Ascend.
- Organize it into reusable Blade components or partials.
- Planned sections include Hero, About, Membership Plans, Trainers, Facilities, Contact, and Footer.

**Naming Conventions**

| Item | Convention | Example |
|---|---|---|
| Models | Singular PascalCase | `MembershipPlan` |
| Controllers | Singular PascalCase + Controller | `MemberController` |
| Tables | Plural snake_case | `membership_plans` |
| Columns | snake_case | `created_at` |
| Form Requests | Action + Resource + Request | `StoreMemberRequest` |
| Middleware | PascalCase + Middleware | `AdminMiddleware` |
| Blade Views | Lowercase, organized by feature | `admin/members/index.blade.php` |

**Development Practices**
- Follow the existing Laravel architecture.
- Keep controllers focused on handling requests.
- Use Form Requests for input validation.
- Define model relationships where necessary.
- Avoid unnecessary files and abstractions.
- Use meaningful, small Git commits.

### November 6, 2026: Development

Development officially begins after the initial research and planning stages.

The initial implementation follows the decisions established during planning, including the database structure, application architecture, folder organization, and naming conventions.

**Initial Progress**
- Laravel project setup.
- Authentication setup using Breeze and Fortify.
- Application structure organized.
- Controllers, middleware, and Form Requests prepared.

**Next Steps**
- Implement database migrations.
- Configure models and relationships.
- Implement backend functionality.
- Develop the admin and member interfaces.

## References

- [Laravel Documentation](https://laravel.com/docs)
- [Laravel Breeze](https://github.com/laravel/breeze)
- [Laravel Fortify](https://laravel.com/docs/fortify)
- [PostgreSQL Documentation](https://www.postgresql.org/docs/)
- [Tailwind CSS Documentation](https://tailwindcss.com/docs)
- [Vite Documentation](https://vite.dev/guide/)
- [Git Documentation](https://git-scm.com/doc)
- [GitHub Actions Documentation](https://docs.github.com/en/actions)
- [Docker Documentation](https://docs.docker.com/)

## Personal Takeaway

Planning before development is more important than I initially realized. Before this, I was more focused on immediately writing code. Taking the time to plan helped me understand the project more deeply.

Defining the database, architecture, responsibilities, naming conventions, and features gave me a clearer direction for development. It also helped identify possible issues before implementation.

I realized that development is not just about writing code. Understanding what needs to be built and how the different parts connect is equally important.
