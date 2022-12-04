<?php
/**
 * Filecreateresponse
 *
 * PHP version 7.4
 *
 * @category Class
 * @package  OpenAPI\Client
 * @author   OpenAPI Generator team
 * @link     https://openapi-generator.tech
 */

/**
 * xpan
 *
 * xpanapi
 *
 * The version of the OpenAPI document: 0.1
 * Generated by: https://openapi-generator.tech
 * OpenAPI Generator version: 6.0.1-SNAPSHOT
 */

/**
 * NOTE: This class is auto generated by OpenAPI Generator (https://openapi-generator.tech).
 * https://openapi-generator.tech
 * Do not edit the class manually.
 */

namespace OpenAPI\Client\Model;

use \ArrayAccess;
use \OpenAPI\Client\ObjectSerializer;

/**
 * Filecreateresponse Class Doc Comment
 *
 * @category Class
 * @package  OpenAPI\Client
 * @author   OpenAPI Generator team
 * @link     https://openapi-generator.tech
 * @implements \ArrayAccess<TKey, TValue>
 * @template TKey int|null
 * @template TValue mixed|null
 */
class Filecreateresponse implements ModelInterface, ArrayAccess, \JsonSerializable
{
    const DISCRIMINATOR = null;

    /**
      * The original name of the model.
      *
      * @var string
      */
    protected static $openAPIModelName = 'filecreateresponse';

    /**
      * Array of property to type mappings. Used for (de)serialization
      *
      * @var string[]
      */
    protected static $openAPITypes = [
        'category' => 'int',
        'ctime' => 'int',
        'from_type' => 'int',
        'fs_id' => 'int',
        'isdir' => 'int',
        'md5' => 'string',
        'mtime' => 'int',
        'path' => 'string',
        'server_filename' => 'string',
        'size' => 'int',
        'errno' => 'int',
        'name' => 'string'
    ];

    /**
      * Array of property to format mappings. Used for (de)serialization
      *
      * @var string[]
      * @phpstan-var array<string, string|null>
      * @psalm-var array<string, string|null>
      */
    protected static $openAPIFormats = [
        'category' => null,
        'ctime' => null,
        'from_type' => null,
        'fs_id' => 'int64',
        'isdir' => null,
        'md5' => null,
        'mtime' => null,
        'path' => null,
        'server_filename' => null,
        'size' => null,
        'errno' => null,
        'name' => null
    ];

    /**
     * Array of property to type mappings. Used for (de)serialization
     *
     * @return array
     */
    public static function openAPITypes()
    {
        return self::$openAPITypes;
    }

    /**
     * Array of property to format mappings. Used for (de)serialization
     *
     * @return array
     */
    public static function openAPIFormats()
    {
        return self::$openAPIFormats;
    }

    /**
     * Array of attributes where the key is the local name,
     * and the value is the original name
     *
     * @var string[]
     */
    protected static $attributeMap = [
        'category' => 'category',
        'ctime' => 'ctime',
        'from_type' => 'from_type',
        'fs_id' => 'fs_id',
        'isdir' => 'isdir',
        'md5' => 'md5',
        'mtime' => 'mtime',
        'path' => 'path',
        'server_filename' => 'server_filename',
        'size' => 'size',
        'errno' => 'errno',
        'name' => 'name'
    ];

    /**
     * Array of attributes to setter functions (for deserialization of responses)
     *
     * @var string[]
     */
    protected static $setters = [
        'category' => 'setCategory',
        'ctime' => 'setCtime',
        'from_type' => 'setFromType',
        'fs_id' => 'setFsId',
        'isdir' => 'setIsdir',
        'md5' => 'setMd5',
        'mtime' => 'setMtime',
        'path' => 'setPath',
        'server_filename' => 'setServerFilename',
        'size' => 'setSize',
        'errno' => 'setErrno',
        'name' => 'setName'
    ];

    /**
     * Array of attributes to getter functions (for serialization of requests)
     *
     * @var string[]
     */
    protected static $getters = [
        'category' => 'getCategory',
        'ctime' => 'getCtime',
        'from_type' => 'getFromType',
        'fs_id' => 'getFsId',
        'isdir' => 'getIsdir',
        'md5' => 'getMd5',
        'mtime' => 'getMtime',
        'path' => 'getPath',
        'server_filename' => 'getServerFilename',
        'size' => 'getSize',
        'errno' => 'getErrno',
        'name' => 'getName'
    ];

    /**
     * Array of attributes where the key is the local name,
     * and the value is the original name
     *
     * @return array
     */
    public static function attributeMap()
    {
        return self::$attributeMap;
    }

    /**
     * Array of attributes to setter functions (for deserialization of responses)
     *
     * @return array
     */
    public static function setters()
    {
        return self::$setters;
    }

    /**
     * Array of attributes to getter functions (for serialization of requests)
     *
     * @return array
     */
    public static function getters()
    {
        return self::$getters;
    }

    /**
     * The original name of the model.
     *
     * @return string
     */
    public function getModelName()
    {
        return self::$openAPIModelName;
    }


    /**
     * Associative array for storing property values
     *
     * @var mixed[]
     */
    protected $container = [];

    /**
     * Constructor
     *
     * @param mixed[] $data Associated array of property values
     *                      initializing the model
     */
    public function __construct(array $data = null)
    {
        $this->container['category'] = isset($data['category']) ? $data['category'] : null;
        $this->container['ctime'] = isset($data['ctime']) ? $data['ctime'] : null;
        $this->container['from_type'] = isset($data['from_type']) ? $data['from_type'] : null;
        $this->container['fs_id'] = isset($data['fs_id']) ? $data['fs_id'] : null;
        $this->container['isdir'] = isset($data['isdir']) ? $data['isdir'] : null;
        $this->container['md5'] = isset($data['md5']) ? $data['md5'] : null;
        $this->container['mtime'] = isset($data['mtime']) ? $data['mtime'] : null;
        $this->container['path'] = isset($data['path']) ? $data['path'] : null;
        $this->container['server_filename'] = isset($data['server_filename']) ? $data['server_filename'] : null;
        $this->container['size'] = isset($data['size']) ? $data['size'] : null;
        $this->container['errno'] = isset($data['errno']) ? $data['errno'] : null;
        $this->container['name'] = isset($data['name']) ? $data['name'] : null;
    }

    /**
     * Show all the invalid properties with reasons.
     *
     * @return array invalid properties with reasons
     */
    public function listInvalidProperties()
    {
        $invalidProperties = [];

        return $invalidProperties;
    }

    /**
     * Validate all the properties in the model
     * return true if all passed
     *
     * @return bool True if all properties are valid
     */
    public function valid()
    {
        return count($this->listInvalidProperties()) === 0;
    }


    /**
     * Gets category
     *
     * @return int|null
     */
    public function getCategory()
    {
        return $this->container['category'];
    }

    /**
     * Sets category
     *
     * @param int|null $category category
     *
     * @return self
     */
    public function setCategory($category)
    {
        $this->container['category'] = $category;

        return $this;
    }

    /**
     * Gets ctime
     *
     * @return int|null
     */
    public function getCtime()
    {
        return $this->container['ctime'];
    }

    /**
     * Sets ctime
     *
     * @param int|null $ctime ctime
     *
     * @return self
     */
    public function setCtime($ctime)
    {
        $this->container['ctime'] = $ctime;

        return $this;
    }

    /**
     * Gets from_type
     *
     * @return int|null
     */
    public function getFromType()
    {
        return $this->container['from_type'];
    }

    /**
     * Sets from_type
     *
     * @param int|null $from_type from_type
     *
     * @return self
     */
    public function setFromType($from_type)
    {
        $this->container['from_type'] = $from_type;

        return $this;
    }

    /**
     * Gets fs_id
     *
     * @return int|null
     */
    public function getFsId()
    {
        return $this->container['fs_id'];
    }

    /**
     * Sets fs_id
     *
     * @param int|null $fs_id fs_id
     *
     * @return self
     */
    public function setFsId($fs_id)
    {
        $this->container['fs_id'] = $fs_id;

        return $this;
    }

    /**
     * Gets isdir
     *
     * @return int|null
     */
    public function getIsdir()
    {
        return $this->container['isdir'];
    }

    /**
     * Sets isdir
     *
     * @param int|null $isdir isdir
     *
     * @return self
     */
    public function setIsdir($isdir)
    {
        $this->container['isdir'] = $isdir;

        return $this;
    }

    /**
     * Gets md5
     *
     * @return string|null
     */
    public function getMd5()
    {
        return $this->container['md5'];
    }

    /**
     * Sets md5
     *
     * @param string|null $md5 md5
     *
     * @return self
     */
    public function setMd5($md5)
    {
        $this->container['md5'] = $md5;

        return $this;
    }

    /**
     * Gets mtime
     *
     * @return int|null
     */
    public function getMtime()
    {
        return $this->container['mtime'];
    }

    /**
     * Sets mtime
     *
     * @param int|null $mtime mtime
     *
     * @return self
     */
    public function setMtime($mtime)
    {
        $this->container['mtime'] = $mtime;

        return $this;
    }

    /**
     * Gets path
     *
     * @return string|null
     */
    public function getPath()
    {
        return $this->container['path'];
    }

    /**
     * Sets path
     *
     * @param string|null $path path
     *
     * @return self
     */
    public function setPath($path)
    {
        $this->container['path'] = $path;

        return $this;
    }

    /**
     * Gets server_filename
     *
     * @return string|null
     */
    public function getServerFilename()
    {
        return $this->container['server_filename'];
    }

    /**
     * Sets server_filename
     *
     * @param string|null $server_filename server_filename
     *
     * @return self
     */
    public function setServerFilename($server_filename)
    {
        $this->container['server_filename'] = $server_filename;

        return $this;
    }

    /**
     * Gets size
     *
     * @return int|null
     */
    public function getSize()
    {
        return $this->container['size'];
    }

    /**
     * Sets size
     *
     * @param int|null $size size
     *
     * @return self
     */
    public function setSize($size)
    {
        $this->container['size'] = $size;

        return $this;
    }

    /**
     * Gets errno
     *
     * @return int|null
     */
    public function getErrno()
    {
        return $this->container['errno'];
    }

    /**
     * Sets errno
     *
     * @param int|null $errno errno
     *
     * @return self
     */
    public function setErrno($errno)
    {
        $this->container['errno'] = $errno;

        return $this;
    }

    /**
     * Gets name
     *
     * @return string|null
     */
    public function getName()
    {
        return $this->container['name'];
    }

    /**
     * Sets name
     *
     * @param string|null $name name
     *
     * @return self
     */
    public function setName($name)
    {
        $this->container['name'] = $name;

        return $this;
    }
    /**
     * Returns true if offset exists. False otherwise.
     *
     * @param integer $offset Offset
     *
     * @return boolean
     */
    public function offsetExists($offset)
    {
        return isset($this->container[$offset]);
    }

    /**
     * Gets offset.
     *
     * @param integer $offset Offset
     *
     * @return mixed|null
     */
    public function offsetGet($offset)
    {
        return isset($this->container[$offset]) ? $this->container[$offset] : null;
    }

    /**
     * Sets value based on offset.
     *
     * @param int|null $offset Offset
     * @param mixed    $value  Value to be set
     *
     * @return void
     */
    public function offsetSet($offset, $value)
    {
        if (is_null($offset)) {
            $this->container[] = $value;
        } else {
            $this->container[$offset] = $value;
        }
    }

    /**
     * Unsets offset.
     *
     * @param integer $offset Offset
     *
     * @return void
     */
    public function offsetUnset($offset)
    {
        unset($this->container[$offset]);
    }

    /**
     * Serializes the object to a value that can be serialized natively by json_encode().
     * @link https://www.php.net/manual/en/jsonserializable.jsonserialize.php
     *
     * @return mixed Returns data which can be serialized by json_encode(), which is a value
     * of any type other than a resource.
     */
    public function jsonSerialize()
    {
       return ObjectSerializer::sanitizeForSerialization($this);
    }

    /**
     * Gets the string presentation of the object
     *
     * @return string
     */
    public function __toString()
    {
        return json_encode(
            ObjectSerializer::sanitizeForSerialization($this),
            JSON_PRETTY_PRINT
        );
    }

    /**
     * Gets a header-safe presentation of the object
     *
     * @return string
     */
    public function toHeaderValue()
    {
        return json_encode(ObjectSerializer::sanitizeForSerialization($this));
    }
}

