<?php
namespace tinymeng\wemeet\TencentCloud\Meeting\V1\Models;

use tinymeng\wemeet\TencentCloud\Common\AbstractModel;

/**
 * 查询会议
 * GetMeetingRequest请求参数结构体
 * https://cloud.tencent.com/document/product/1095/93432
 * @method string getMeetingId()
 * @method void setMeetingId(string $DomainName) 有效的会议 ID。
 * @method string getOperatorId()
 * @method void setOperatorId(string $AppName) 操作者 ID。operator_id 必须与 operator_id_type 配合使用。根据 operator_id_type 的值，operator_id 代表不同类型。
 * @method string getOperatorIdType()
 * @method void setOperatorIdType(string $StreamName) 操作者 ID 的类型：3：rooms_id 说明：当前仅支持 rooms_id。如操作者为企业内 userid 或 openId，请使用 userid 字段。
 * @method string getInstanceId()
 * @method void setInstanceId(string $StreamName) 设置流名称。用户的终端设备类型： 0：PSTN 1：PC 2：Mac 3：Android 4：iOS 5：Web 6：iPad 7：Android Pad 8：小程序 9：voip、sip 设备 10：linux 20：Rooms for Touch Windows 21：Rooms for Touch MacOS 22：Rooms for Touch Android 30：Controller for Touch Windows 32：Controller for Touch Android 33：Controller for Touch iOS
 */
class GetMeetingRequest extends AbstractModel
{
    /**
     * @var string 查询会议专用参数。
     */
    public $meeting_id;
    public $operator_id;
    public $operator_id_type;
    public $instanceid;


    /**
     */
    function __construct()
    {

    }

    /**
     * For internal only. DO NOT USE IT.
     */
    public function deserialize($param)
    {
        if ($param === null) {
            return;
        }

        if (array_key_exists("meeting_id",$param) and $param["meeting_id"] !== null) {
            $this->meeting_id = $param["meeting_id"];
        }

        if (array_key_exists("operator_id",$param) and $param["operator_id"] !== null) {
            $this->operator_id = $param["operator_id"];
        }

        if (array_key_exists("operator_id_type",$param) and $param["operator_id_type"] !== null) {
            $this->operator_id_type = $param["operator_id_type"];
        }

        if (array_key_exists("instanceid",$param) and $param["instanceid"] !== null) {
            $this->instanceid = $param["instanceid"];
        }


    }
}
