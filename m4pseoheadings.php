<?php

declare(strict_types=1);

/**
 * m4pseoheadings
 *
 * @author    Modules4Presta <contact@modules4presta.io>
 * @copyright 2026 Nice Code sp. z o.o. (Modules4Presta)
 * @license   https://opensource.org/licenses/MIT MIT License
 */

if (!defined('_PS_VERSION_')) {
    exit;
}

/**
 * Demotes <h1> written in back-office content (product descriptions, CMS pages, category descriptions,
 * blog posts) to <h2> when it is displayed, so every page keeps a single H1: its title.
 */
class M4pseoheadings extends Module
{
    public function __construct()
    {
        $this->name = 'm4pseoheadings';
        $this->tab = 'seo';
        $this->version = '1.0.0';
        $this->author = 'Modules4Presta';
        $this->need_instance = 0;
        $this->ps_versions_compliancy = ['min' => '8.0.0', 'max' => _PS_VERSION_];

        parent::__construct();

        $this->displayName = $this->trans('Single H1 in content', [], 'Modules.M4pseoheadings.Admin');
        $this->description = $this->trans('Shows H1 headings typed into descriptions and pages as H2, so the page title stays the only H1.', [], 'Modules.M4pseoheadings.Admin');
    }

    public function isUsingNewTranslationSystem(): bool
    {
        return true;
    }

    public function install(): bool
    {
        return parent::install()
            && $this->registerHook('actionPresentProduct')
            && $this->registerHook('actionPresentProductListing')
            && $this->registerHook('filterCmsContent')
            && $this->registerHook('filterCategoryContent');
    }

    /**
     * <h1 …> and </h1> become <h2 …> and </h2>; anything else is left as it is.
     */
    public static function demote(string $html): string
    {
        if (stripos($html, '<h1') === false) {
            return $html;
        }

        return (string) preg_replace('~<(/?)h1(?=[\s>/])~i', '<$1h2', $html);
    }

    /**
     * @param array{presentedProduct: \PrestaShop\PrestaShop\Adapter\Presenter\Product\ProductLazyArray} $params
     */
    public function hookActionPresentProduct(array $params): void
    {
        $this->demoteFields($params['presentedProduct'], ['description', 'description_short']);
    }

    /**
     * @param array{presentedProduct: \PrestaShop\PrestaShop\Adapter\Presenter\Product\ProductListingLazyArray} $params
     */
    public function hookActionPresentProductListing(array $params): void
    {
        $this->demoteFields($params['presentedProduct'], ['description', 'description_short']);
    }

    /**
     * @param array{object: array<string, mixed>} $params
     *
     * @return array{object: array<string, mixed>}
     */
    public function hookFilterCmsContent(array $params): array
    {
        $this->demoteFields($params['object'], ['content']);

        return ['object' => $params['object']];
    }

    /**
     * @param array{object: array<string, mixed>} $params
     *
     * @return array{object: array<string, mixed>}
     */
    public function hookFilterCategoryContent(array $params): array
    {
        $this->demoteFields($params['object'], ['description', 'additional_description']);

        return ['object' => $params['object']];
    }

    /**
     * @param array<string, mixed>|\ArrayAccess<string, mixed> $data
     * @param string[] $fields
     */
    private function demoteFields(&$data, array $fields): void
    {
        foreach ($fields as $field) {
            if (isset($data[$field]) && is_string($data[$field])) {
                $data[$field] = self::demote($data[$field]);
            }
        }
    }
}
