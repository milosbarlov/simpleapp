<?php

/**
 * @author Dragan Zivkovic <dragan.zivkovic.ts@gmail.com>
 * Created on 18.07.2013.,12.19.46
 * 
 */
Yii::import('system.cli.commands.MessageCommand');

class DbMessageCommand extends MessageCommand {

    public function run($args) {
        if (!isset($args[0]))
            $this->usageError('the configuration file is not specified.');

        if (!is_file($args[0]))
            $this->usageError("the configuration file {$args[0]} does not exist.");

        $config = require_once($args[0]);
        $translator = 'Yii::t';
        extract($config);

        if (!isset($sourcePath, $messagePath, $languages))
            $this->usageError('The configuration file must specify "sourcePath", "messagePath" and "languages".');
        if (!is_dir($sourcePath))
            $this->usageError("The source path $sourcePath is not a valid directory.");
        if (!is_dir($messagePath))
            $this->usageError("The message path $messagePath is not a valid directory.");
        if (empty($languages))
            $this->usageError("Languages cannot be empty.");

        if (!isset($overwrite))
            $overwrite = false;

        if (!isset($removeOld))
            $removeOld = false;

        if (!isset($sort))
            $sort = false;

        $options = array();
        if (isset($fileTypes))
            $options['fileTypes'] = $fileTypes;
        if (isset($exclude))
            $options['exclude'] = $exclude;
        $files = CFileHelper::findFiles(realpath($sourcePath), $options);

        $messages = array();
        foreach ($files as $file)
            $messages = array_merge_recursive($messages, $this->extractMessages($file, $translator));

        $categories = array();
        Yii::app()->db->createCommand()->dropForeignKey('FK_Message_SourceMessage', 'Message');

        foreach ($languages as $language) {
            foreach ($messages as $category => $msgs) {
                $msgs = array_values(array_unique($msgs));
                $this->populateDbTable($msgs, $category, $language);
                $categories[] = $category;
            }
        }
        $categories = array_values(array_unique($categories));
        // clear all unused categories from database
        $db_cats = Yii::app()->db->createCommand('SELECT DISTINCT(`category`) FROM `SourceMessage`')->queryAll();
        if ($db_cats) {
            foreach ($db_cats as $cat) {
                if (!in_array($cat['category'], $categories)) {
                    $sMessages = SourceMessage::model()->findAllByAttributes(array('category' => $cat['category']));
                    if ($sMessages) {
                        foreach ($sMessages as $sm) {
                            Yii::app()->db->createCommand('DELETE FROM `Message` WHERE `id` = ' . $sm->id)->execute();
                            $sm->delete();
                        }
                    }
                }
            }
        }
        Yii::app()->db->createCommand()->addForeignKey('FK_Message_SourceMessage', 'Message', 'id', 'SourceMessage', 'id', 'CASCADE', 'CASCADE');
    }

    protected function populateDbTable($messages, $category, $language) {
        $db = TranslateSourceMessage::model()->findAllByAttributes(array('category' => $category));
        $oldMessages = array();
        if (!empty($db)) {
            foreach ($db as $d) {
                $oldMessages[$d->message] = $d->id;
                if ($language == 'en') {
                    $current = $d->message;
                    if (!in_array($current, $messages)) {
                        Yii::app()->db->createCommand('DELETE FROM `Message` WHERE `id` = ' . $d->id)->execute();
                        $d->delete();
                    }
                }
            }
        }

        foreach ($messages as $m) {
            if (!isset($oldMessages[$m])) {
                $model = new TranslateSourceMessage;
                $model->category = $category;
                $model->message = $m;
                $model->save();
            }
        }
    }

}
