<?php
require_once('./Services/EventHandling/classes/class.ilEventHookPlugin.php');
require_once('class.ilAllEventLoggingModel.php');

class ilAllEventLoggingPlugin extends ilEventHookPlugin{


    /**
     * @return string
     */
    public function getPluginName() {
        return 'AllEventLogging';
    }

    /**
     * @param $a_component
     * @param $a_event
     * @param $a_parameter
     */
    public function handleEvent($a_component, $a_event, $a_parameter)
    {
        global $ilLog;
        if($this->saveEvent($a_component,$a_event,$a_parameter)) {
            $ilLog->write('Wrote Event to DB'.$a_event);
        }
    }

    /**
     * @param $component
     * @param $event
     * @param $parameter
     * @return bool
     */
    public function saveEvent($component,$event,$parameter)
    {
        $event_object = new ilAllEventLoggingModel();
        $event_object->setComponent($component);

        if(array_key_exists('obj_id',$parameter)){
            $event_object->setObjId($parameter['obj_id']);
        }

        if(array_key_exists('usr_id',$parameter)){
            $event_object->setUsrId($parameter['usr_id']);
        }

        if(!empty($parameter)){
            $event_object->setParameters(json_encode($parameter));
        }

        $event_object->setEvent($event);
        $event_object->create();
        return true;
    }



}



?>