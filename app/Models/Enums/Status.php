<?php
  
namespace App\Enums;
 
enum Status:string {
    case Pending = 'pending';
    case IN_PROGRESS = 'IN PROGRESS';
    case APPROVED = 'APPROVED';
    case Rejected = 'rejected';
}