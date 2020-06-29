<?php
/**
 * \LiipDrupalPractice\Sniffs\NamingConventions\CamelCaseMethodParameterSniff.
 *
 * @category PHP
 * @package  PHP_CodeSniffer
 * @link     http://pear.php.net/package/PHP_CodeSniffer
 */

namespace LiipDrupalPractice\Sniffs\NamingConventions;

use PHP_CodeSniffer\Files\File;
use PHP_CodeSniffer\Sniffs\AbstractScopeSniff;

/**
 * Checks that private methods are actually used in a class.
 *
 * @category PHP
 * @package  PHP_CodeSniffer
 * @link     http://pear.php.net/package/PHP_CodeSniffer
 */
class CamelCaseMethodParameterSniff extends AbstractScopeSniff
{


    /**
     * Constructor.
     */
    public function __construct()
    {
        parent::__construct([T_CLASS], [T_FUNCTION], false);

    }//end __construct()


    /**
     * Processes the tokens within the scope.
     *
     * @param \PHP_CodeSniffer\Files\File $phpcsFile The file being processed.
     * @param int                         $stackPtr  The position where this token was
     *                                               found.
     * @param int                         $currScope The position of the current scope.
     *
     * @return void
     */
    protected function processTokenWithinScope(File $phpcsFile, $stackPtr, $currScope)
    {
        $methodParams = $phpcsFile->getMethodParameters($stackPtr);
        foreach ($methodParams as $methodParam) {
          $methodName = ltrim($methodParam['name'],"$");

            if (preg_match('/^[a-z]/', $methodName) === 1 && strpos($methodName, '_') === false) {
                return;
            }

            $warning = 'Method parameter should user lowerCamel naming without underscores: %s';
            $data    = [$methodParam['name']];
            $phpcsFile->addWarning($warning, $stackPtr, 'LowerCamelName', $data);

        }

    }//end processTokenWithinScope()


    /**
     * Process tokens outside of scope.
     *
     * @param \PHP_CodeSniffer\Files\File $phpcsFile The file being processed.
     * @param int                         $stackPtr  The position where this token was
     *                                               found.
     *
     * @return void
     */
    protected function processTokenOutsideScope(File $phpcsFile, $stackPtr)
    {

    }//end processTokenOutsideScope()


}//end class
