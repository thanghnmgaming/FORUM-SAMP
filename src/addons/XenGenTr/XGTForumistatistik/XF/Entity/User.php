<?php

namespace XenGenTr\XGTForumistatistik\XF\Entity;

class User extends XFCP_User
{
    public function canIstatistikleriGor()
    {
        $visitor = \XF::visitor();

        if($this->hasPermission('XGT_istatistik_izin_grubu', 'XGT_istatistik_gor'))
        {
            return true;
        }
    } 

    public function canKullaniciIstatistikGor()
    {
        $visitor = \XF::visitor();

        if($this->hasPermission('XGT_istatistik_izin_grubu', 'XGT_istatistik_kullanici'))
        {
            return true;
        }
    } 
}