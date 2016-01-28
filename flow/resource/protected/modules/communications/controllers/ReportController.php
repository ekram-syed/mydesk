<?php

class ReportController extends Controller {

    public $pageTitle = "Communication Services";

    public function filters() {
        return array(
            'accessControl'
        );
    }

    public function accessRules() {
        return array(
            array('allow',
                'actions' => array('requisition', 'billing', 'feedback'),
                'users' => array('@'),
            ),
            array('deny',
                'users' => array('*'),
            ),
        );
    }

    public function actionIndex() {
        $this->render('index');
    }

    public function actionRequisition() {

        $bill_dept = "select  bill_dept  from comm_photographies 
                      union
                      select  bill_dept from comm_audiovisuals
                      union
                      select  bill_dept from  comm_design
                      union
                      select  bill_dept from comm_printings";
        $billingDept = Yii::app()->db->createCommand($bill_dept)->queryAll();

        $i = 0;
        foreach ($billingDept as $key => $val) {
            $bill[$billingDept[$i]['bill_dept']] = $billingDept[$i]['bill_dept'];
            $i++;
        }
        $billingDept = $bill;



        //$bill_dept = Yii::app()->request->getParam('billingDept');
        $fromdate = Yii::app()->request->getParam('fromdate');
        $todate = Yii::app()->request->getParam('todate');

        $photographyCriteria = new CDbCriteria;
        //$photographyCriteria->condition = "bill_dept='$bill_dept' AND created_time>='$fromdate' AND created_time<='$todate'";
        $photographyCriteria->condition = "created_time>='$fromdate' AND created_time<='$todate'";
        $photographyCriteria->order = 'id DESC';
        $dataPhotography = new CActiveDataProvider('Photography', array('criteria' => $photographyCriteria, 'pagination' => false));

        $designCriteria = new CDbCriteria;
        //$designCriteria->condition = "bill_dept='$bill_dept' AND created_time>='$fromdate' AND created_time<='$todate'";
        $designCriteria->condition = "created_time>='$fromdate' AND created_time<='$todate'";
        $designCriteria->order = 'id DESC';
        $dataDesign = new CActiveDataProvider('Design', array('criteria' => $designCriteria, 'pagination' => false));

        $audiovisualCriteria = new CDbCriteria;
        //$audiovisualCriteria->condition = "bill_dept='$bill_dept' AND created_time>='$fromdate' AND created_time<='$todate'";
        $audiovisualCriteria->condition = "created_time>='$fromdate' AND created_time<='$todate'";
        $audiovisualCriteria->order = 'id DESC';
        $dataAudiovisual = new CActiveDataProvider('Audiovisual', array('criteria' => $audiovisualCriteria, 'pagination' => false));

        $printingCriteria = new CDbCriteria;
        //$printingCriteria->condition = "bill_dept='$bill_dept' AND created_time>='$fromdate' AND created_time<='$todate'";
        $printingCriteria->condition = "created_time>='$fromdate' AND created_time<='$todate'";
        $printingCriteria->order = 'id DESC';
        $dataPrinting = new CActiveDataProvider('Printing', array('criteria' => $printingCriteria, 'pagination' => false));

        $this->render('requisition', array(
            'billingDept' => $billingDept,
            'dataPhotography' => $dataPhotography,
            'dataDesign' => $dataDesign,
            'dataAudiovisual' => $dataAudiovisual,
            'dataPrinting' => $dataPrinting,
            'fromdate' => $fromdate,
            'todate' => $todate,
        ));
    }

    public function actionBilling() {

        $bill_dept = "select  bill_dept  from comm_photographies 
                      union
                      select  bill_dept from comm_audiovisuals
                      union
                      select  bill_dept from  comm_design
                      union
                      select  bill_dept from comm_printings";
        $billingDept = Yii::app()->db->createCommand($bill_dept)->queryAll();

        $i = 0;
        foreach ($billingDept as $key => $val) {
            $bill[$billingDept[$i]['bill_dept']] = $billingDept[$i]['bill_dept'];
            $i++;
        }
        $billingDept = $bill;



        $bill_dept = Yii::app()->request->getParam('billingDept');
        $fromdate = Yii::app()->request->getParam('fromdate');
        $todate = Yii::app()->request->getParam('todate');

        $postVal['bill_dept'] = $bill_dept;
        $postVal['from_date'] = $fromdate;
        $postVal['to_date'] = $todate;

        $photographyCriteria = new CDbCriteria;
        $photographyCriteria->condition = "bill_dept='$bill_dept' AND created_time>='$fromdate' AND created_time<='$todate'";
        $dataPhotography = new CActiveDataProvider('Photography', array('criteria' => $photographyCriteria));
        $photographyCriteria->order = 'id DESC';

        $designCriteria = new CDbCriteria;
        $designCriteria->condition = "bill_dept='$bill_dept' AND created_time>='$fromdate' AND created_time<='$todate'";
        $dataDesign = new CActiveDataProvider('Design', array('criteria' => $designCriteria));
        $designCriteria->order = 'id DESC';

        $audiovisualCriteria = new CDbCriteria;
        $audiovisualCriteria->condition = "bill_dept='$bill_dept' AND created_time>='$fromdate' AND created_time<='$todate'";
        $dataAudiovisual = new CActiveDataProvider('Audiovisual', array('criteria' => $audiovisualCriteria));
        $audiovisualCriteria->order = 'id DESC';

        $printingCriteria = new CDbCriteria;
        $printingCriteria->condition = "bill_dept='$bill_dept' AND created_time>='$fromdate' AND created_time<='$todate'";
        $dataPrinting = new CActiveDataProvider('Printing', array('criteria' => $printingCriteria));
        $printingCriteria->order = 'id DESC';

        $this->render('billing', array(
            'billingDept' => $billingDept,
            'dataPhotography' => $dataPhotography,
            'dataDesign' => $dataDesign,
            'dataAudiovisual' => $dataAudiovisual,
            'dataPrinting' => $dataPrinting,
            'postVal' => $postVal,
            'fromdate' => $fromdate,
            'todate' => $todate,
        ));
    }

    public function actionFeedback() {

        $teamMembers = TeamMembers::model()->findAll(array('select' => 'user_pin, user_name', 'distinct' => true,));

        $teamMember = Yii::app()->request->getParam('team_member');
        $fromdate = Yii::app()->request->getParam('fromdate');
        $todate = Yii::app()->request->getParam('todate');

        //CVarDumper::dump($teamMember);


        $photographyCriteria = new CDbCriteria;
        $photographyCriteria->condition = " find_in_set('" . Yii::app()->user->name . "', team_members)  AND created_time>='$fromdate' AND created_time<='$todate'";
        $dataPhotography = new CActiveDataProvider('Photography', array('criteria' => $photographyCriteria));
        $photographyCriteria->order = 'id DESC';

        $designCriteria = new CDbCriteria;
        $designCriteria->condition = " find_in_set('" . Yii::app()->user->name . "', team_members)  AND created_time>='$fromdate' AND created_time<='$todate'";
        $dataDesign = new CActiveDataProvider('Design', array('criteria' => $designCriteria));
        $designCriteria->order = 'id DESC';

        $audiovisualCriteria = new CDbCriteria;
        $audiovisualCriteria->condition = " find_in_set('" . Yii::app()->user->name . "', team_members)  AND created_time>='$fromdate' AND created_time<='$todate'";
        $dataAudiovisual = new CActiveDataProvider('Audiovisual', array('criteria' => $audiovisualCriteria));
        $audiovisualCriteria->order = 'id DESC';

        $printingCriteria = new CDbCriteria;
        $printingCriteria->condition = " find_in_set('" . Yii::app()->user->name . "', team_members)  AND created_time>='$fromdate' AND created_time<='$todate'";
        $dataPrinting = new CActiveDataProvider('Printing', array('criteria' => $printingCriteria));
        $printingCriteria->order = 'id DESC';

        $this->render('feedback', array(
            'teamMembers' => $teamMembers,
            'dataPhotography' => $dataPhotography,
            'dataDesign' => $dataDesign,
            'dataAudiovisual' => $dataAudiovisual,
            'dataPrinting' => $dataPrinting,
            'teamMember' => $teamMember,
            'fromdate' => $fromdate,
            'todate' => $todate,
        ));
    }

}
