<?php
/**
 *
 * @package app
 */
class Metric_CMC_Varnish_Worststreams extends Metric_Base
{

    /**
     * Returns the used database type
     *
     * @access protected
     * @return String 'mysql'
     */
    protected function getDatabaseType()
    {
        return 'mysql';
    }

    /**
     * Returns the used database connection
     * @access protected
     * @return String 'headwaters'
     */
    protected function getConnection()
    {
        return 'cmcbackup';
    }

    /**
     * Generates region trend data for player data
     *
     * @access public
     * @param  String $dateStart Y-m-d formatted date, beginning date of range
     * @param  String $dateEnd   Y-m-d formatted date, end date of range
     * @return Array  Array of daily availability grouped by date
     */
    public function worststreams($dateStart, $dateEnd)
    {
        $this->date = $this->provideDateFilter('varnish_cmc_daily', 'date_created');
        $select = DB::select('date_created','site', 'title','httpError','errorfree')->from('VarnishWorst10Channels');
        $select = $this->date->filterByDateRange($select, $dateStart, $dateEnd);
        $select->order_by('date_created', 'ASC');
        return $this->runQuery($select);
    }

}
