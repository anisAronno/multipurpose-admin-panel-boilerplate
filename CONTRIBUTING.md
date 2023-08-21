# Contributing to Multipurpose Admin Panel Boilerplate

Thank you for considering contributing to the Multipurpose Admin Panel Boilerplate! We welcome any contributions that will help improve and enhance the project. Whether you want to report a bug, suggest new features, or submit code changes, this guide will provide you with the necessary information to get started.

## Table of Contents

- [Code of Conduct](#code-of-conduct)
- [Reporting Issues](#reporting-issues)
- [Feature Requests](#feature-requests)
- [Development Setup](#development-setup)
- [Creating Pull Requests](#creating-pull-requests)
- [Coding Guidelines](#coding-guidelines)
- [License](#license)

## Code of Conduct

Before you start contributing, please read and adhere to our [Code of Conduct](CODE_OF_CONDUCT.md). We expect all contributors to follow these guidelines to ensure a positive and inclusive community.

## Reporting Issues

If you encounter any bugs, issues, or unexpected behavior while using the Multipurpose Admin Panel Boilerplate, please check the existing issues on GitHub to see if it has already been reported. If not, you can submit a new issue following these steps:

1. Go to the [Issues](https://github.com/anisaronno/multipurpose-admin-panel-boilerplate/issues) section of the repository.
2. Click on the "New Issue" button.
3. Select the appropriate issue template (bug report, feature request, etc.).
4. Fill in the required details, providing a clear and concise description of the problem or suggestion.

Once you've submitted an issue, our team will review it and respond as soon as possible. Be patient and provide any additional information that might be helpful for resolving the problem.

## Feature Requests

We encourage you to submit feature requests if you have ideas to improve the Multipurpose Admin Panel Boilerplate. To request a new feature:

1. Go to the [Issues](https://github.com/anisaronno/multipurpose-admin-panel-boilerplate/issues) section of the repository.
2. Click on the "New Issue" button.
3. Select the "Feature Request" template.
4. Describe the feature you'd like to see, providing as much context as possible.

Our team will review the request, and if it aligns with the project's goals, we may add it to our roadmap.

## Development Setup

To set up the development environment for the Multipurpose Admin Panel Boilerplate, follow these steps:

1. Fork the repository to your GitHub account.
2. Clone the forked repository to your local machine.
3. Install dependencies by running `composer install` and `npm install` in the project root folder.
4. Configure your database connection by updating the `.env` file.
5. Run database migrations with `php artisan migrate` and seed the database with `php artisan db:seed`.
6. Start the development server using `php artisan serve`.

## Creating Pull Requests

If you want to contribute code changes or bug fixes to the project, please follow these steps:

1. Create a new branch based on the `develop` branch with a descriptive name (e.g., `feature/new-feature` or `bugfix/issue-123`).
2. Implement your changes, ensuring that your code adheres to the [coding guidelines](#coding-guidelines).
3. Commit your changes with clear and concise commit messages.
4. Push your branch to your forked repository on GitHub.
5. Open a pull request (PR) against the `main` branch of the original repository.
6. Provide a detailed description of your changes and the problem they address in the PR description.

Note: We are encouraged to use git flow.
Our team will review your PR, provide feedback if needed, and merge it once everything looks good.

## Coding Guidelines

To maintain consistency and readability in the codebase, please follow these guidelines when contributing:

- Use meaningful variable and function names.
- Adhere to the existing coding style, including indentation and formatting.
- Comment your code, especially in complex or ambiguous sections, to improve understanding.
- Write clear and concise commit messages, explaining the purpose of each commit.

## License

By contributing to the Multipurpose Admin Panel Boilerplate, you agree that your contributions will be licensed under the [MIT License](LICENSE).
