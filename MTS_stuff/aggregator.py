import pandas as pd
from pyspark.sql.types import StructType, StructField, StringType
from spark_py_utils.clickstream import join_to_clickstream
	
def aggregator_v3(task_num, input_excel, label, dt1, dt2):
    
    df = pd.read_excel(input_excel, dtype = object, header = None)
    df.columns = ['host_name','seg']
    
    schema = StructType([StructField('host_name', StringType(), True), StructField('seg', StringType(), True)])
    df_f = spark.createDataFrame(df, schema)
    df_f.select("host_name", "seg").distinct().groupby("seg").count().orderBy('seg', ascending=True).show()
    
    dwh_saver(join_to_clickstream(spark, hosts_df=df_f, start_dt=dt1, end_dt=dt2), task_num, label=label, persistent='True')
    
    return spark.sql("select seg, count(distinct msisdn) cnt from advert_sb.bbi_seg{}_{} group by seg".format(task_num, label)).show()