<?php
    class Team {
        public $name;
        public $group_name;
        public $group_order;
        public $parent_group_name;
        public $parent_group_order;
        public $flag_filename;
        public $logo_filename;
        function __construct($name, $group_name, $group_order,
                             $parent_group_name, $parent_group_order,
                             $flag_filename, $logo_filename = '') {
            $this->name = $name;
            $this->group_name = $group_name;
            $this->group_order = $group_order;
            $this->parent_group_name = $parent_group_name;
            $this->parent_group_order = $parent_group_order;
            $this->flag_filename = $flag_filename;
            $this->logo_filename = $logo_filename;
        }
    }
