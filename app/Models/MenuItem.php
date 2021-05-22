<?php


namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MenuItem extends Model
{
    public function scopeGetMenuItems($query)
    {
        $menuItems = $query->get();
        return $this->buildMenuItems($menuItems->toArray());
    }

    public function buildMenuItems(array $elements, $parentId = 0)
    {
        $branch = array();
        
        foreach ($elements as $element) {
            if ($element['parent_id'] == $parentId) {
                $children = $this->buildMenuItems($elements, $element['id']);
                if ($children) {
                    $element['children'] = $children;
                }
                $branch[] = $element;
            }
        }
    
        return $branch;
    }
}
