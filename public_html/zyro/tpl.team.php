<?php
    class Team {
        public $name;
        public $group_name;
        public $group_order;
        public $parent_group_name;
        public $parent_group_order;
        function __construct($name, $group_name, $group_order) {
            $this -> name = $name;
            $this -> group_name = $group_name;
            $this -> group_order = $group_order;
        }
        function Team($name, $group_name, $group_order, $parent_group_name, $parent_group_order) {
            $this -> name = $name;
            $this -> group_name = $group_name;
            $this -> group_order = $group_order;
            $this -> parent_group_name = $parent_group_name;
            $this -> parent_group_order = $parent_group_order;
        }
    }
