def dwh_saver(df, task_num, label, persistent):
    assert isinstance(label, str), 'label should be str'
    assert isinstance(persistent, str), 'persistent should be True or False'
    assert isinstance(task_num, str), 'task_num should be str'
    if persistent=='True':
        df.write.format("orc").mode('overwrite').saveAsTable('advert_sb.bbi_seg{}_{}'.format(task_num, label))
    elif persistent=='False':
        df.createOrReplaceTempView('bbi_seg{}_{}'.format(task_num, label))