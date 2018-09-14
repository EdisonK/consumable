<?php

namespace App\Traits;

use App\Models\Activity;

trait Recording
{
    /**
     * 日志记录的Relation
     * @return mixed
     */
    public function activities()
    {
        return $this->morphMany(Activity::class, 'subject');
    }

    /**
     * 创建一个日志记录对象
     * @param $forEvent
     * @return mixed
     */
    public function recorder($forEvent)
    {
        return $this->activities()->create([
            'type' => $forEvent,
            'user_id' => auth()->id(),
        ]);
    }

    /**
     * 直接记录当前model的创建操作
     * @return mixed
     */
    public function recordCreate()
    {
        return $this->activities()->create([
            'type' => 'create_' . snake_case(class_basename($this)),
            'user_id' => auth()->id(),
            'new' => $this->toArrayForRecording(),
        ]);
    }

    /**
     * 指明需要记录的Model数据，默认为全部属性
     * @return mixed
     */
    public function toArrayForRecording()
    {
        return $this->toArray();
    }
}
