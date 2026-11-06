# Ascend - Claude Development Context

## Project Overview

Ascend is an integrated web-based gym management system developed for an academic project.

**Submission deadline:** November 6, 2026, 11:59 PM.

The goal is to build a working and demonstrable MVP that satisfies the course requirements.

Prioritize functionality, clear architecture, and a simple interface. Do not overdesign or introduce unnecessary features.

## Technologies

| Technology | Purpose |
|---|---|
| Laravel 13.39.0 | Backend framework |
| PHP | Backend language |
| MySQL | Database |
| Blade | View templating |
| Tailwind CSS | Styling |
| Vite | Asset bundling |
| JavaScript | Frontend interactions |
| Laravel Breeze | Authentication scaffolding |
| Laravel Fortify | Authentication backend |
| Git / GitHub | Version control |

Use the existing project dependencies and configuration. Do not introduce another frontend framework.

## Main Application Features

### Public
- Landing page
- Registration
- Login

### Admin
- Dashboard
- Member management
- Trainer management
- Membership plan management
- Product inventory
- Sales management
- Payment records
- Gym visit records

### Member
- Dashboard
- Membership details
- Membership plans
- Shop
- Gym visit check-in
- Visit history
- Profile

Prioritize the features needed to demonstrate the project requirements. Do not attempt to finish every optional feature before the core system works.

## Database Overview

Use **MySQL**.

Existing planned tables:

- `users`
- `members`
- `trainers`
- `membership_plans`
- `member_subscriptions`
- `payments`
- `products`
- `sales`
- `sold_products`
- `gym_visits`

Important decisions:
- User accounts and member records are separate.
- Membership plans can be associated with trainers.
- Subscriptions connect members to their purchased plans.
- Payments support membership and product transactions.
- Product sales contain individual records in `sold_products`.
- Gym visits record check-ins only. No checkout feature.
- A member can only check in once per calendar day.

Preserve established relationships unless a necessary change is discussed and approved.

## Architecture

Follow Laravel MVC conventions.

- Models handle database entities and relationships.
- Controllers handle requests and application logic.
- Form Requests validate incoming data.
- Middleware protects routes and restricts access.
- Blade views handle the interface.
- Reusable Blade components should prevent duplicated markup.

Suggested view organization:

```text
resources/views/
├── layouts/
│   ├── app.blade.php
│   ├── admin.blade.php
│   └── user.blade.php
├── components/
│   ├── ui/
│   └── layout/
├── admin/
│   ├── dashboard/
│   ├── members/
│   ├── trainers/
│   ├── membership-plans/
│   ├── products/
│   └── sales/
├── user/
│   ├── dashboard/
│   ├── membership/
│   ├── shop/
│   ├── visits/
│   └── profile/
└── welcome.blade.php
```

Inspect the actual project before creating or moving files. Preserve existing Laravel and authentication files.

## Phase One: Simple Interface

Build the interface first.

Required:
- Public landing page
- Admin layout
- Member layout
- Sidebar and header
- Page headings
- Buttons
- Cards
- Tables
- Form inputs
- Status indicators
- Alerts and confirmation dialogs

Rules:
- Keep the interface simple and functional.
- Use consistent spacing and typography.
- Make navigation functional.
- Use reusable components where appropriate.
- Prepare components to accept dynamic data.
- Avoid advanced animations, excessive decoration, and unnecessary design work.

## Naming Conventions

| Element | Convention | Example |
|---|---|---|
| Models | Singular PascalCase | `MembershipPlan` |
| Controllers | Singular PascalCase + Controller | `MemberController` |
| Requests | Action + Resource + Request | `StoreMemberRequest` |
| Middleware | PascalCase + Middleware | `AdminMiddleware` |
| Database tables | Plural snake_case | `membership_plans` |
| Database columns | snake_case | `created_at` |
| Blade views | lowercase | `index.blade.php` |
| Blade components | kebab-case | `stat-card.blade.php` |
| CSS files | kebab-case | `admin-layout.css` |
| JavaScript files | kebab-case | `dashboard.js` |
| JS variables | camelCase | `totalProducts` |
| JS functions | camelCase | `calculateTotal()` |
| CSS classes | kebab-case | `dashboard-card` |

Use meaningful and descriptive names. Avoid unnecessary abbreviations.

## Code Comment Conventions

Keep comments minimal and direct.

PHP and JavaScript:

```php
// Calculates the product total
```

CSS:

```css
/* Cards */

/* Navigation */

/* Tables */
```

Use valid CSS comment syntax.

HTML and Blade:
- No comments.
- Do not add section labels or obvious explanations.

Do not comment on code that is already self-explanatory.

## Development Rules

1. Inspect existing files before modifying anything.
2. Follow the existing Laravel architecture.
3. Do not unnecessarily refactor working code.
4. Do not duplicate existing components.
5. Do not create unnecessary files or folders.
6. Do not add features outside the agreed MVP.
7. Use server-side validation.
8. Never hardcode production secrets.
9. Test changes before reporting completion.
10. Explain important changes briefly.

## Git Rules

Follow the project's existing `COMMIT_CONVENTION.md` or equivalent reference.

If asked to create a commit:
- Read the actual commit convention first.
- Use its established prefixes and formatting.
- Make small, meaningful commits.
- Do not invent new commit types.

Avoid editing shared files owned by another development session.

## Collaboration Rules

Claude sessions have separate task ownership.

- Claude 1: Layouts, components, landing page.
- Claude 2: Database, migrations, models, seeders.
- Claude 3: Authentication, middleware, reCAPTCHA.
- Claude 4: Member and product CRUD.

Wait for database schema confirmation before implementing dependent CRUD features.

Do not modify shared files assigned to another session without coordination.

The lead developer handles route integration, code review, testing, and deployment.

## Expected Result

Deliver a simple, working, database-connected Laravel application that demonstrates:

- Public and authenticated pages.
- Authentication and role-based access.
- Related MySQL tables.
- CRUD operations.
- Validated forms.
- reCAPTCHA security.
- Database-driven dashboard chart.
- Search and filtering.
- Online deployment.

**Main objective: Complete the required working features before spending time on visual polish.**
