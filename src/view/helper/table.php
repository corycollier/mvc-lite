<?php
/**
 * Table View Helper
 *
 * @category    MvcLite
 * @package     Lib
 * @subpackage  View_Helper
 * @since       File available since release 1.1.x
 * @author      Cory Collier <corycollier@corycollier.com>
 */

namespace MvcLite\View\Helper;

/**
 * Table View Helper class
 *
 * @category    MvcLite
 * @package     Lib
 * @subpackage  View_Helper
 * @since       Class available since release 1.1.x
 * @author      Cory Collier <corycollier@corycollier.com>
 */
class Table extends \MvcLite\View\HelperAbstract
{
    /**
     * method to return a list of table headers for a given array of data
     *
     * @param array $data
     * @return string
     */
    public function getHeaders($data = array())
    {
        $template = '<th>!label</th>';

        $link = '<a href="!href">!label</a>';

        $result = '';

        // iterate through the data, building a string of th elements
        foreach ($data as $key => $label) {
            $result .= strtr($template, array(
                '!label' => $this->getSortHeader($label, $key),
            ));
        }

        $result .= strtr($template, array(
            '!label'    => 'actions',
        ));

        return implode(PHP_EOL, array(
            '<tr>', $result, '</tr>',
        ));

    }

    /**
     *
     * returns a sortable header link
     *
     * @param string $label
     * @param string $column
     */
    public function getSortHeader($label, $column)
    {
        $link = '<a href="!href">!label</a>';

        $request = Request::getInstance();

        $params = array_intersect_key($request->getParams(), array(
            'controller'    => '',
            'action'        => '',
        ));

        $order = $request->getParam('order');

        $order = ($order == 'desc')
            ? 'asc'
            : 'desc';

        return strtr($link, array(
            '!label'    => $label,
            '!href'        => '/' . implode('/', array_merge($params, array(
                'sort'    => "sort/{$column}+{$order}",
                'order'    => "order/{$order}",
            ))),
        ));


    }


    /**
     * method to return a table row from a given array of data
     *
     * @param \MvcLite\ModelAbstract $model
     * @return string
     */
    public function getRow(ModelAbstract $model)
    {
        $template = '<td>!data</td>';

        $result = '';

        $fields = $model->getFields();

        // iterate through the data, building a string of td elements
        foreach ($model->toArray() as $key => $value) {
            if (@$fields[$key]['reference']) {
                $property = $fields[$key]['reference']['property'];
                $model->$property->load(array(
                    $fields[$key]['reference']['foreign_key'] => $value,
                ));

                if ($model->$property->isLoaded()) {
                    $value = $model->{$property};
                }
            }
            $result .= strtr($template, array(
                '!data' => strip_tags($value),
            ));
        }

        $result .= strtr($template, array(
            '!data' => $this->getActions($model),
        ));

        return implode(PHP_EOL, array(
            '<tr>', $result, '</tr>',
        ));

    }

    /**
     * returns the actions available to a model
     *
     * @param \MvcLite\ModelAbstract $model
     */
    public function getActions(ModelAbstract $model)
    {
        $actions = array(
            'view', 'edit', 'delete',
        );

        $controller = Lib_Request::getInstance()->getParam('controller');

        $template = '<li><a href="!href">!label</a></li>';

        $result = '';
        $separator = '';

        // iterate through the actions
        foreach ($actions as $action) {
            $result .= $separator . strtr($template, array(
                '!label' => $action,
                '!href'  => "/{$controller}/{$action}/id/" . $model->get('id'),
            ));
            $separator = '|';
        }

        return implode(PHP_EOL, array(
            '<ul class="actions">',
            $result,
            '</ul>',
        ));

    }

} // END class Lib_View_Helper_Table
