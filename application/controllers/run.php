<?php
class Run extends MY_Controller
{
    public $cdn;
    public function __construct()
    {
        parent::__construct();
    }
    /**
     * 生成对账单
     * @return [type] [description]
     */
    public function statement($day)
    {
        // echo $day;
        if(!$day){
            $day = date('Y-m-d');
        }
        $timestamp = strtotime($day);
        $this->load->model('gamemodel');
        $this->load->model('ordermodel');
        $this->load->model('channelmodel');
        $this->load->model('statementmodel');
        $games    = $this->gamemodel->get_all(array());
        $channels = $this->channelmodel->get_all(array());
        foreach ($games as $game) {
            $game_id = $game['id'];

            foreach ($channels as $channel) {

                $where = array(
                    'gameid'         => $game_id,
                    'date_timestamp' => $timestamp,
                    'pay_success'    => 1,
                    'paytype'        => $channel['id'],
                );
                $earning_where = $refund_where = $where;
                // 收入
                $earning_where['trade_type']=ORDER_PAY;
                $earning = $this->ordermodel->get_money($earning_where);
                // 退款
                $refund_where['trade_type']=ORDER_REFUND;
                $refund = $this->ordermodel->get_money($refund_where);
                $data = array(
                    'game_id' => $game_id,
                    'firm_id' => $game['firm_id'],
                    'channel_id'=>$channel['id'],
                    'date'=>date('Ymd',$timestamp),    
                    'earning_money'=>sprintf('%0.02f',$earning['fact_money']),  
                    'earning_order'=>(int) $earning['order_num'],
                    'refund_money'=>sprintf('%0.02f',$refund['fact_money']),  
                    'refund_order'=>(int) $refund['order_num'],                    
                );
                $this->statementmodel->add($data);
            }
            // var_dump($earning ,$refund );

        }
        //var_dump($games);
    }

    public function refund_do()
    {

        $this->load->model('refundmodel');

        $orders = $this->refundmodel->get_all(
                array('status'=>2)
            );

        foreach($orders as $order){


            $url = "xxx.php?id=".$order['id'];

            file_get_contents($url);
        }

        $this->db->trans_start();
    }
}
