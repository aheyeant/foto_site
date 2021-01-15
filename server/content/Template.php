<?php


class Template {

    private $dir_tmpl;       // dir to tpl-files
    private $data = array(); // templates data


    /**
     * Template constructor.
     * @param $dir_tmpl
     */
    public function __construct($dir_tmpl)
    {
        $this->dir_tmpl = $dir_tmpl;
    }


    /**
     * Method for adding new values to output data
     * @param $name - template name
     * @param $value - template value
     */
    public function set($name, $value)
    {
        $this->data[$name] = $value;
    }

    /**
     * Method for removing values from output data
     * @param $name - template name
     */
    public function delete($name)
    {
        unset($this->data[$name]);
    }

    /**
     * When accessing, for example, $this->title, $this->data["title"] will be displayed
     * @param $name
     * @return mixed
     */
    public function __get($name)
    {
        if (isset($this->data[$name])) return $this->data[$name];
        return "";
    }

    /**
     * Output of a tpl-file, into which all data for output is substituted
     * @param $template - tpl-file
     */
    public function display($template)
    {
        $template = $this->dir_tmpl.$template.".tpl";
        ob_start();
        include ($template);
        echo ob_get_clean();
    }
}