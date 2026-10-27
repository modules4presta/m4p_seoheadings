# Single H1 in content for PrestaShop 8 & 9

**Keeps one H1 per page when the people writing your descriptions paste headings from Word, without editing a single description.**

> **Meta description (155 chars):** Demotes H1 headings typed into PrestaShop descriptions and CMS pages to H2, so the page title stays the only H1. Free, MIT licensed.

---

## Why a second H1 is a problem worth fixing

A product description written in a word processor arrives with its own heading structure. Pasted into the back office, that heading becomes an `<h1>` inside a page that already has one: the product name. The template is correct, the content is not, and nobody notices until an audit reports two H1 elements on a few hundred pages.

The usual fix is to open every description and change the heading by hand, then do it again after the next person pastes from Word. Nothing in the back office prevents it, because the editor is allowed to produce any HTML.

- **No content to re-edit** – descriptions, CMS pages and category texts stay as they are.
- **No template changes** – the theme keeps its own single H1.
- **Nothing to remember** – a heading pasted next month is handled the same way.

## What the module does

The module changes the headings while the page is being rendered: an `<h1>` found in content coming from the back office is displayed as `<h2>`, with its attributes untouched. The stored content is not modified, so switching the module off brings the original markup back.

### Key features

- **Product descriptions** – both the full and the short description, on product pages and in listings.
- **CMS pages** – the content of every CMS page.
- **Category texts** – the description and the additional description.
- **Attributes preserved** – classes, ids and inline styles on the heading survive the change.
- **No configuration** – nothing to set up; it works once installed.

### Content without an H1

A text with no `<h1>` is passed through untouched, and the module does nothing at all for content rendered outside those hooks – a module's own template, for instance, keeps whatever it renders. The database is never written to, so uninstalling the module restores the previous output immediately.

## Compatibility

| | |
|---|---|
| PrestaShop | 8.0 – 9.x |
| PHP | 7.4+ |
| Requirements | none |
| Multistore | Works per installation; nothing to configure per shop |
| Themes | Works with any theme; no template overrides required |

The module overrides no core class and creates no database table.

## Installation

1. Upload and install the module from **Modules → Module Manager**.
2. Clear the shop cache.
3. Check a product whose description contains a heading: its H1 is now rendered as H2.

A heading that stays an H1 is coming from the template rather than from the content – that is the page title, and it is the one H1 the page should have.

## Configuration options

The module has no settings.

## Frequently asked questions

**Does it change my descriptions in the database?**
No. The change happens while the page is rendered; the stored HTML is untouched.

**Does it affect the page title?**
No. The title rendered by the theme stays the only H1 on the page.

**What about headings already written as H2 or H3?**
They are left alone. Only H1 is demoted, and only by one level.

---

**Keywords:** prestashop multiple h1, prestashop single h1, prestashop seo headings, prestashop h1 in description, prestashop heading structure

## License

MIT – see [LICENSE](LICENSE). Free to use commercially, fork and modify; keep the copyright notice.

## Contributing

Bug reports and pull requests are welcome – see [CONTRIBUTING.md](CONTRIBUTING.md). For security
issues, follow [SECURITY.md](SECURITY.md) instead of opening a public issue.

---

Built by [Nice Code](https://nice-code.com/pl/oferta/moduly-prestashop) – we build and maintain PrestaShop stores.

© Nice Code sp. z o.o. (Modules4Presta) – released under the MIT license.
