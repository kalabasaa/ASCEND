<h1 align="center">Commit Convention</h1>

<p align="center">
  Reference for commit message prefixes used in this project.
  ASCEND follows the Conventional Commits specification to maintain clear, consistent, and meaningful Git commit history.
</p>


## Commit Format

```text
<type>: <description>
```

## Commit Types

| **Type**   | **When to use it** |
| ---------- | ------------------ |
| `feat`     | Add a new feature |
| `bugfix`   | Fix a bug |
| `refactor` | Improve code without changing behavior |
| `docs`     | Documentation changes |
| `chore`    | Maintenance tasks |
| `style`    | Formatting only, no logic changes |
| `test`     | Add or update tests |
| `build`    | Build system or dependency configuration |
| `hotfix`   | Urgent fix for a production issue |
| `perf`     | Improve performance |
| `revert`   | Undo a previous commit |

## Examples

```text
feat: add membership registration
fix: correct payment calculation
docs: update installation guide
style: improve dashboard spacing
refactor: simplify membership validation
perf: optimize attendance queries
test: add payment calculation tests
build: update Laravel dependencies
chore: organize project assets
```

## Guidelines

- Use lowercase commit types.
- Write descriptions in the imperative or direct form.
- Keep commit messages short and specific.
- Focus each commit on one logical change.
- Avoid vague descriptions such as `update`, `changes`, or `fixed stuff`.
- Do not combine unrelated changes into one commit.

## References

- [Conventional Commits](https://www.conventionalcommits.org/)
