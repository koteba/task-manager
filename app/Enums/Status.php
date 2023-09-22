<?php
  
  namespace App\Enums;

  class Status
  {
      const PENDING = 'pending';
      const IN_PROGRESS = 'IN PROGRESS';
      const APPROVED = 'APPROVED';
      const REJECTED = 'rejected';
  
      public static function getValues()
      {
          return [
              self::PENDING,
              self::APPROVED,
              self::IN_PROGRESS,
              self::REJECTED,
          ];
      }
  }
   
